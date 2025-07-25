<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class BookingNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $type;
    protected $company_id;
    protected $link;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $type = 'info', $company_id, $link)
    {
        $this->message = $message;
        $this->type = $type;
        $this->company_id = $company_id;
        $this->link = $link;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }
    public function toDatabase($notifiable)
    {
        return [
            'company_id' => $this->company_id,
            'link' => $this->link,
            'message' => $this->message,
            'type' => $this->type,
        ];
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
