<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ProductPurchasedNotification;
use Mail;

class SendProductPurchaseNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductPurchased  $event
     * @return void
     */
    public function handle(ProductPurchased $event)
    {
        //send mail here
        /*
        Mail::send('emails.product_purchased', $event->product->user->email, function($message){
            $message->subject('New Product Purchase');
        });
        **/
        Mail::send( new ProductPurchasedNotification($event->product));
    }
}
