<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendProductEmailNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
     $user = User::find(7);

        Mail::send('emails.event_order_placed', [
            'user'=> $user,
            'product'=> $event->product
        ], function ($m) use ($user) {
            $m->to($user['email']);
            $m->subject('Thanks for your order');
            $m->from('no-reply@shouts.dev', 'Shouts.dev');
        });

    }
}






