<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first();
        $notification->markAsRead();

        // Redirect to linked page
        $data = $notification->data;
        return redirect('admin/' . $data['link']);
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)->first;
        $notification->delete();

        return back()->with('success', 'Notification removed.');
    }
}
