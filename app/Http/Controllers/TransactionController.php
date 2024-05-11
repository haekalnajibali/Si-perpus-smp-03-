<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\TransaksiPengembalian;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd( Transaction::first());
        return view('dashboard.transactions.index', [
            'active' => 'transactions',
            'transactions' => Transaction::latest()
                ->filter(request(['search']))
                ->paginate(7)
                ->withQueryString(),
            'count' => Transaction::get()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.transactions.create', [
            'books' => Book::all(),
            'members' => Member::all(),
            'active' => 'transactions',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    // public function pengembalian()
    // {
    //     dd('alole');
    //     return view('dashboard.transactions.create');
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        // Validate unique combination
        $request->validate([
            'book_id' => [
                'required',
                Rule::unique('transaksi_pengembalians')->where(function ($query) use ($request) {
                    return $query->where('book_id', $request->book_id)
                        ->where('member_id', $request->member_id);
                }),
            ],
        ], [
            'book_id.unique' => 'Transaksi dengan buku dan anggota tersebut sudah ada.',
        ]);

        // Check if eksemplar is greater than or equal to jml_pinjam
        $book = Book::find($request->book_id);
        if ($book->eksemplar < $request->jml_pinjam) {
            throw ValidationException::withMessages([
                'jml_pinjam' => 'Jumlah pinjaman melebihi jumlah eksemplar yang tersedia.',
            ]);
        }
        // Decrement the eksemplar count of the book
        $book->decrement('eksemplar', $request->jml_pinjam);

        // Create a new transaction record
        $transaction = Transaction::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'member_id' => $request->member_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'jml_pinjam' => $request->jml_pinjam,
            'status' => $request->status,
        ]);

        // Create a new transaksi_pengembalian record
        TransaksiPengembalian::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'transaction_id' => $transaction->id,
        ]);

        return redirect('/dashboard/transactions')->with('success', 'Transaksi baru telah ditambahkan.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function prosespengembalian(Request $request)
    {
        // Retrieve the transaction based on the combination of member_id and book_id
        $return_transaction = TransaksiPengembalian::where('member_id', $request->member_id)
            ->where('book_id', $request->book_id)
            ->first();

        // Check if the transaction exists
        if ($return_transaction) {

            // Update the transaction details
            $transaction = Transaction::find($return_transaction->transaction_id);

            // Get the current date and time in the same format as tgl_kembali
            $tgl_pengembalian = Carbon::now()->format('Y-m-d');
            // Calculate jml_hari and denda
            $tgl_pinjam = new Carbon($transaction->tgl_pinjam);
            $tgl_kembali = new Carbon($tgl_pengembalian);
            $difference = $tgl_kembali->diffInDays($tgl_pinjam);
            $jml_hari = $difference;
            $denda = $jml_hari > 7 ? ($jml_hari - 7) * 500 : 0;

            // Update the transaction details
            $transaction->update([
                'status' => 'PENGEMBALIAN',
                'tgl_pengembalian' => $tgl_kembali,
                'jml_hari' => $jml_hari,
                'denda' => $denda,
            ]);

            $return_transaction->delete();

            // Increment the eksemplar count of the book
            Book::find($request->book_id)->increment('eksemplar', $transaction->jml_pinjam);

            return redirect('/dashboard/transactions')->with('success', 'Pengembalian telah selesai.');
        } else {
            return redirect('/dashboard/pengembalians')->with('error', 'Pengembalian tidak ditemukan.');
        }
    }

    public function proseshapus(Request $request)
    {
        // Retrieve the transaction
        $transaction = Transaction::find($request['id']);

        if ($transaction) {
            // Increment the eksemplar count of the book
            Book::find($transaction->book_id)->increment('eksemplar', $transaction->jml_pinjam);

            // Delete the transaction
            $transaction->delete();

            // Delete the associated record from transaksi_pengembalian table
            TransaksiPengembalian::where('transaction_id', $request['id'])->delete();

            return redirect('/dashboard/transactions')->with('success', 'Transaksi berhasil dihapus.');
        } else {
            return redirect('/dashboard/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function hapus(Request $request)
    {
        return view('dashboard.transactions.delete', [
            'books' => Book::all(),
            'members' => Member::all(),
            'transaction' => Transaction::where('id', $request->id)->first(),
            'active' => 'transactions',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('dashboard.transactions.edit', [
            'books' => Book::all(),
            'members' => Member::all(),
            'transaction' => $transaction,
            'active' => 'transactions',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        if ($request->status == 'PEMINJAMAN') {
            Transaction::where('id', $request['id'])->update([
                'book_id' => $request->book_id,
                'user_id' => $request->user_id,
                'member_id' => $request->member_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'jml_pinjam' => $request->jml_pinjam,
                'status' => $request->status,
            ]);
            Book::find($request->book_id)->increment('eksemplar', $transaction['jml_pinjam']);
            Book::find($request->book_id)->decrement('eksemplar', $request['jml_pinjam']);
            return redirect('/dashboard/transactions')->with('success', 'Transaksi telah diubah.');
        } else {
            Transaction::where('id', $request['id'])->update([
                'book_id' => $request->book_id,
                'user_id' => $request->user_id,
                'member_id' => $request->member_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'jml_pinjam' => $request->jml_pinjam,
                'status' => $request->status,
                'tgl_pengembalian' => $request->tgl_pengembalian,
                'jml_hari' => $request->jml_hari,
                'denda' => $request->denda,
            ]);
            Book::find($request->book_id)->increment('eksemplar', $transaction['jml_pinjam']);
            Book::find($request->book_id)->decrement('eksemplar', $request['jml_pinjam']);
            return redirect('/dashboard/transactions')->with('success', 'Transaksi telah diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);
        return redirect('/dashboard/transactions')->with('success', 'Transaksi telah dihapus.');
    }
}
