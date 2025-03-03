<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Models\Sale;

class PaymentDue extends Notification
{
    use Queueable;

    /**
     * The sale instance.
     *
     * @var \App\Models\Sale
     */
    public $sale;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $sale = $this->sale;

        if (!$sale->due_amount || !$sale->payment_date) {
            $payment_date = Carbon::parse($sale->date)->addDays(15);

            if (now()->gt($payment_date)) {
                return [
                    'message' => 'Payment for sale with reference ' . $sale->reference . ' is due',
                    'sale_id' => $sale->id,
                ];
            }
        }

        return [
            'message' => 'Payment for sale with reference ' . $sale->reference . ' is due on ' . $sale->date,
            'sale_id' => $sale->id,
        ];
    }

}