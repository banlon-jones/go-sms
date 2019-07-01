<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use App\Message;
use Illuminate\Http\Request;
class StatisticsController extends Controller
{

    //
    public function statistics()
    {
        $allTransactions =Transaction::all();
        //generating monthly graph statistics
        $monthlyAmount = collect([]);
        $numberOfMessages = collect([]);
        for ($month = 1; $month <= 12; $month++) {
            $transactions = Transaction::whereYear('created_at', '=', date("Y"))->whereMonth('created_at', '=', $month)->get()->pluck("amount")->sum();
            $monthlyAmount->push($transactions);
        }
        for ($month = 1; $month <= 12; $month++) {
            $transactions = Transaction::whereYear('created_at', '=', date("Y"))->whereMonth('created_at', '=', $month)->get()->pluck("recipients")->sum();
            $numberOfMessages->push($transactions);
        }
        //number of validated users
        $validateUsers = User::where('status', 1)->get()->count();
        // number of unverified users
        $unverifiedUsers = User::where('status', 0)->get()->count();
        //number of privilege users
        $users = User::all()->count();
        $privilegeUsers = $users - User::where('role_id', null)->get()->count();
        return view('statistics.statistics', ['numb' => $numberOfMessages, 'amount' => $monthlyAmount, 'privilegeUsers'
        => $privilegeUsers, 'unverifiedUsers' => $unverifiedUsers,
            'validateUsers' => $validateUsers,'transactions'=>$allTransactions, 'totalUsers'=>$users]);
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
     public function graph()
     {

     }


}
