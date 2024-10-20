<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportErrorNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;
    protected $rowInfo;

    /**
     * Create a new notification instance.
     *
     * @param string $message
     * @param mixed $rowInfo
     */
    public function __construct(string $message, $rowInfo = null)
    {
        $this->message = $message;
        $this->rowInfo = $rowInfo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // You can choose to notify via database and email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Import Error Notification')
            ->line($this->message)
            ->line('Row Info: ' . ($this->rowInfo ?? 'N/A')) // Display row information if available
            ->action('View Import Status', url('/imports')) // Adjust URL as needed
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
            'message' => $this->message,
            'row_info' => $this->rowInfo,
        ];
    }
}
