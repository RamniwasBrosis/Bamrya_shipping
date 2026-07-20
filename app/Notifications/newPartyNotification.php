<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newPartyNotification extends Notification
{
    use Queueable;
    
    protected $masterParty;
    protected $party_type;

    /**
     * Create a new notification instance.
     */
    public function __construct($masterParty, $party_type)
    {
        $this->masterParty = $masterParty;
        $this->party_type = $party_type;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'party_type' => $this->party_type,
            'party_id' => $this->masterParty->id,
            'party_name' => $this->masterParty->party_name,
            'message' => "A new party {$this->masterParty->party_name} created please Approve Document related this Party.",
        ];
    }
}
