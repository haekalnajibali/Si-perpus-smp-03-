<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Member;
use App\Models\Transaction;
use PDF;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaction::select(DB::raw("(count(id)) as banyak"), DB::raw("(DATE_FORMAT(tgl_pinjam, '%M-%Y')) as month_year"))
            ->orderBy('tgl_pinjam')
            ->groupBy(DB::raw("DATE_FORMAT(tgl_pinjam, '%M-%Y')"))
            ->get();

        foreach ($transaksi as $index) {
            // date("m",strtotime($index['month_year']));
            $labeltransaksi[] = date("M Y", strtotime($index['month_year']));
            $banyaktransaksi[] = $index['banyak'];
        }
        $buku = Book::select(DB::raw("(count(id)) as banyak"), DB::raw("(DATE_FORMAT(created_at, '%M-%Y')) as month_year"))
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M-%Y')"))
            ->get();

        foreach ($buku as $index) {
            // date("m",strtotime($index['month_year']));
            $labelbuku[] = date("M Y", strtotime($index['month_year']));
            $banyakbuku[] = $index['banyak'];
        }
        if($buku->first() == NULL){
            $labelbuku = NULL;
            $banyakbuku = NULL;
        }
        if($transaksi->first() == NULL){
            $labeltransaksi = NULL;
            $banyaktransaksi = NULL;
        }
        return view('dashboard.reports.index', [
            'active' => 'reports',
            'labeltransaksi' => json_encode($labeltransaksi),
            'banyaktransaksi' => $banyaktransaksi,
            'labelbuku' => json_encode($labelbuku),
            'banyakbuku' => $banyakbuku,
            'dateawal' => Transaction::min('tgl_pinjam'),
            'dateakhir' => Transaction::max('tgl_pinjam'),
        ]);
    }

    public function books()
    {
        $books = Book::all();

        $pdf = PDF::loadView('book_pdf', ['books' => $books]);
        return $pdf->download('laporan-buku-'. date('d-m-Y') .'.pdf');
    }

    public function users()
    {
        $users = User::all();

        $pdf = PDF::loadview('user_pdf', ['users' => $users]);
        return $pdf->download('laporan-user-'. date('d-m-Y') .'.pdf');
    }

    public function members()
    {
        $members = Member::all();

        $pdf = PDF::loadview('member_pdf', ['members' => $members]);
        return $pdf->download('laporan-member-'. date('d-m-Y') .'.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transactions(Request $request)
    {
        $transactions = Transaction::whereBetween('tgl_pinjam', [$request->tgl_awal, $request->tgl_akhir])->get();


        $pdf = PDF::loadview('transactions_pdf', ['transactions' => $transactions])->setPaper('a4');
        return $pdf->download('laporan-transactions-'. date('d-m-Y') .'.pdf');
    }
}
