<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Pedido;
use Carbon\Carbon;
use App\Comprador;
use App\Tienda;
class pedidoNotification extends Notification
{
    protected $comment;
 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment,$ids)
    {
        $this->comment = $comment;
         $this->ids = $ids; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */ 
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'pedido'=>$this->ids,
            'estado'=>$this->comment,
            'time'=>Carbon::now()->diffForHumans(),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
 
}
