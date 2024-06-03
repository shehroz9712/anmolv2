<?php

namespace App\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

trait NotificationTrait
{
    /**
     * Send a notification.
     *
     * @param mixed $notifiable The entity to notify.
     * @param string $message The notification message.
     * @param string $type The type of notification (info, success, error, etc.).
     */
    public function sendNotification($user, $subject, $message)
    {

        Notification::create([
            'sender_id' => Auth::id(),
            'sender_type' => $user == 'admin' ? 'admin' : 'user',
            'user_id' => 10,
            'user_type' => $user == 'admin' ? 'admin' : 'user',
            'subject' => $subject,
            'message' => $message

        ]);
    }
}
