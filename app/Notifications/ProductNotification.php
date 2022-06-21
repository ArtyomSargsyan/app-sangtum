<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use phpDocumentor\Reflection\DocBlock\Description;

class ProductNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private string $name;
    private string $description;
    private string $price;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable ): MailMessage
    {
        return (new MailMessage)
                    ->line($this->name)
                    ->line($this->description)
                    ->action('Notification Action', url('/'))
                    ->line($this->price);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
          'name'=> $this->name,
          'description'=> $this->description,
          'price'=> $this->price
        ];
    }
}
