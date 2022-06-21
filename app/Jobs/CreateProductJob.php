<?php

namespace App\Jobs;


use App\Mail\ProductMail;
use App\Notifications\ProductNotification;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class CreateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     *
     */
    private string $name;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var int
     */
    private int $price;

    /**
     * @var int
     */
    private int $userId;

    /**
     * @var string
     */
    private string $user;

    /**
     * @param string $name
     * @param string $description
     * @param int $price
     * @param int $userId
     */
    public function __construct(string $name, string $description, int $price, int $userId )
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->userId = $userId;

    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $ProductRepository = new ProductRepository();
        $ProductRepository->store($this->name, $this->description, $this->price,$this->userId);

        $user = (new UserRepository())->getUserById($this->userId);
        //Notification::send($user, new ProductNotification($this->name, $this->description, $this->price));

      /* $email = new ProductMail($this->name,$this->description,$this->price);
        Mail::to($user['email'])->send($email);*/

    }
}
