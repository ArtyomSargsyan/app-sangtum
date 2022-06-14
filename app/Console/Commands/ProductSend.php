<?php

namespace App\Console\Commands;

use App\Mail\ProductMail;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ProductSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mail {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new product';

    /**
     * Execute the console command.
     *
     * @return void
     * @throws ValidationException
     */
    public function handle()
    {

        $emailStr = $this->option('email');

        $emailsArr = explode(',', $emailStr);


        $product = Product::find(1);

        foreach ($emailsArr as $value) {

            $validator = Validator::make(['email' => $value], [
                'email' => 'required|email'
            ]);

            if ($validator->validate()) {
                Mail::to($value)->send(new ProductMail ($product));
            }
        }

    }

}
