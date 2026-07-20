<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobStatusChangedNotification extends Notification
{
    use Queueable;
    
    protected $job;
    protected $status;
    protected $changedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct($job, $status, $changedBy)
    {
        $this->job = $job;
        $this->status = $status;
        $this->changedBy = $changedBy;
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
            'job_id' => $this->job->id,
            'job_no' => $this->job->job_no,
            'status' => $this->status == 'C' ? 'Closed' : 'Opened',
            'changed_by' => $this->changedBy->name ?? 'System',
            'message' => "Job {$this->job->job_no} has been " . 
                         ($this->status == 'C' ? 'closed' : 'opened') . 
                         " by {$this->changedBy->name}.",
        ];
    }
}
