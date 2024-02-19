<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        /**
         * @var User $user
         */

        $user = Auth::user();

        $contact = $request->input("user");

        $conversations = $user->conversations();

        $content = ($contact !== null ? $conversations[$contact] : $conversations->first())->reverse();

        return view("inbox.show", compact(["conversations", "content"]));
    }

    public function store(CreateMessageRequest $request)
    {
        $data = $request->safe()->merge(['sender_id' => auth()->id()])->toArray();

        /**
         * @var \App\Models\Message $message
         */
        $message = Message::create($data);

        // send a notification

        Notification::create([
            'user_id' => $message->receiver_id,
            'message' => Auth::user()->firstname . ' ' .  Auth::user()->lastname . ' have just sent you a message.',
            'link' => "/inbox/?user=" . $message->sender_id
        ]);

        return back();
    }
}
