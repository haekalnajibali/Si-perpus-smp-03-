<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $chart = Transaction::select(DB::raw("(count(id)) as banyak"), DB::raw("(DATE_FORMAT(tgl_pinjam, '%M-%Y')) as month_year"))
        //     ->orderBy('tgl_pinjam')
        //     ->groupBy(DB::raw("DATE_FORMAT(tgl_pinjam, '%M-%Y')"))
        //     ->get();

        // foreach ($chart as $index) {
        //     // date("m",strtotime($index['month_year']));
        //     $label[] = date("M Y", strtotime($index['month_year']));
        //     $banyak[] = $index['banyak'];
        // }
        // dd($label);
        return view('dashboard.index', [
            'active' => 'index',
            'countuser' => User::count(),
            'countmember' => Member::count(),
            'countbook' => Book::count(),
            'counttransaction' => Transaction::count(),
            // 'label' => json_encode($label),
            // 'banyak' => $banyak,
            'users' => User::where('id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
