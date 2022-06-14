<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $description;
    protected string $name;
    protected int  $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( string $name, string $description, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
       //dd($name);
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {

        return $this->view('emails.send_email_job' )->with([
            'name'=> $this->name,
            'description'=> $this->description,
            'price' => $this->price
        ]);
    }
}
