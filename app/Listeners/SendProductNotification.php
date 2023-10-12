<?php

namespace App\Listeners;

use App\Events\NewProduct;
use App\Mail\NewProduct as MailNewProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendProductNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewProduct $event): void
    {
        //
        $admin =Auth::guard('admin')->user();
        $url = url('dashboard/product/products/'.$event->product->id);
        Mail::to($admin->email)->send(new MailNewProduct($admin,$event->product,$url));
    }
}
