<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactions(){
            $transactions = Transaction::where('user_id', Auth::user()->id)->get();
            return view('transactions.transaction',['transactions'=>$transactions]);
    }
    public function receipt($id){
        //check if transaction belong to user
        $transaction = Transaction::find($id);
        if ($transaction->user_id == Auth::user()->id){
            return view('transactions.receipt',['transaction'=>$transaction]);
        }
    }
    public function downloadReceipt($id){
        $transaction = Transaction::find($id);
        if ($transaction->user_id == Auth::user()->id){
            $user = User::find(Auth::user()->id);

            // Send data to the view using loadView function of PDF facade
            $pdf = PDF::loadView('transactions.download_receipt', ['transaction' => $transaction, 'user' =>$user]);

            // Finally, you can download the file using download function
            return $pdf->download('receipt.pdf');
        }


    }


}
