<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Notifications\PaymentDue;
use App\Models\Sale;
use App\Models\User;

class PaymentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sale;

    /**
     * Create a new job instance.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->sale->due_amount || !$this->sale->payment_date) {
            // $payment_date = Carbon::parse($this->sale->date)->addDays(15);
           
            // if (now()->gt($payment_date)) {
                $user = User::find(1);
                
                $user->notify(new PaymentDue($this->sale));
            // } 
        
        } 

    }
}
