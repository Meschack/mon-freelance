<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        /**
         * @var \App\Models\User $user
         */

        $user = auth()->user();

        $notifications = $user->notifications()->whereNull('deleted_at')->orderBy('created_at', 'asc')->paginate(2);

        // Mark all notifications as read

        $user->notifications()->whereNull('deleted_at')->update(['have_been_read' => true]);

        return view('notifications.index', compact('notifications'));
    }
}
