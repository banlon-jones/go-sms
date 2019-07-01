<?php

namespace App\Http\Controllers;
use App\Tarif;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //generating monthly graph statistics
        $numberOfMessages = collect([]);
        $user_id = Auth::user()->id;
        $tarif = Tarif::all();
        for ($month = 1; $month <= 12; $month ++) {
            $transactions = Transaction::where('user_id', $user_id)->whereYear('created_at', '=', date("Y"))->whereMonth('created_at', '=', $month)->get()->pluck("recipients")->sum();
            $numberOfMessages->push($transactions);
        }
        return view('home',['numb'=>$numberOfMessages,'tarifs'=>$tarif]);
    }
}
