<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class TaskNotification extends Notification
{
    use Queueable;

    private $message;
    private $url;

    public function __construct($message, $url)
    {
        $this->message = $message;
        $this->url = $url; // A link to the task or relevant page
    }

    public function via($notifiable)
    {
        return ['database']; // Use the database channel for storing notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'url' => $this->url,
            'date' => now()->format('d M, Y'),
        ];
    }
}
