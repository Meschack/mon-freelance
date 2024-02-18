<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Models\Message;
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

        $displayedConversation = ($contact !== null ? $conversations[$contact] : $conversations->first())->reverse();

        // dump($displayedConversation);

        return view("inbox.show", compact(["conversations", "displayedConversation"]));
    }

    public function store(CreateMessageRequest $request)
    {
        $data = $request->safe()->merge(['sender_id' => auth()->id()])->toArray();

        $message = Message::create($data);

        return back();
    }
}
