<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatGroup;
use App\Models\ChatMessage;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
    public function groups(Request $request) {
        return ChatGroup::all();
    }

    public function messages(Request $request, $groupId) {
        return ChatMessage::where('id_chat_group', $groupId)
            ->with('user')->orderBy('created_at', 'DESC')->get();
    }

    public function newMessage(Request $request, $groupId) {
        $newMessage = new ChatMessage;
        $newMessage->id_user = Auth::id();
        $newMessage->id_chat_group = $groupId;
        $newMessage->message = $request->message;
        $newMessage->save(); //saved

        broadcast(new NewChatMessage( $newMessage ))->toOthers();

        return $newMessage;
    }
}
