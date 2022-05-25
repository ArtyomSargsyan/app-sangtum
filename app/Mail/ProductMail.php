<?php

namespace App\Mail;


use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public  $product;


    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Product $product)
    {

        $this->product = $product;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->subject('Mail product mailer' )
            ->view('emails.email');
    }
}
