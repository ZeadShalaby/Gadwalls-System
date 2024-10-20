<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SlackAlertNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    //
    public function markAsRead($notifyid)
    {
        $notification = auth()->user()->notifications()->find($notifyid);

        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back()->with('success', 'Notification marked as read.');
    }


}










