<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddOrderClient extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Successful installation notification from fshoes')
            ->greeting('Fshoes hello ' . $this->order->user->name)
            ->line('Confirm your information')
            ->line('Order number : ' . $this->order->sku_order)
            ->line('Order value : ' . number_format($this->order->total_amount) . ' vnđ')
            ->line('Name : ' . $this->order->user_name)
            ->line('Email : ' . $this->order->user_email)
            ->line('Phone : ' . $this->order->user_phone)
            ->line('Address : ' . $this->order->user_address)
            ->line('Note : ' . $this->order->user_note)
            ->action('Order details', url('/'))
            ->salutation('Thank you for trusting Fshoes');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
