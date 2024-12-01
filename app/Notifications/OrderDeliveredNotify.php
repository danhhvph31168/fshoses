<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDeliveredNotify extends Notification implements ShouldQueue
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
        $orderItemsContent = '';
        foreach ($this->order->orderItems as $item) {
            $orderItemsContent .= " - {$item->productVariant->product->name}: {$item->price}({$item->quantity}) ";
        }
        return (new MailMessage)
            ->subject('Your order has been successfully processed')
            ->greeting('Fshoes hello ' . $this->order->user->name)
            ->line('Confirm your information')
            ->line('Order number : ' . $this->order->sku_order)
            ->line('Order value : ' . number_format($this->order->total_amount) . ' vnđ')
            ->line('Product : '.$orderItemsContent)
            ->line('Email : ' . $this->order->user_email)
            ->line('Phone : ' . $this->order->user_phone)
            ->line('Address : ' . $this->order->user_address)
            ->line('Note : ' . $this->order->user_note)
            ->action('Order details', url("/order-item/{$this->order->sku_order}"))
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
