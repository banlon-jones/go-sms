<?php

namespace App\Jobs;
use App\user;
use App\Transaction;
use App\message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class sendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $account;
    protected $channel;
    protected $amount;
    protected $message;
    protected $recipient;
    protected $contacts;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $contacts )
    {
        foreach($contacts as $contact){
            return 'hello';
        }

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
