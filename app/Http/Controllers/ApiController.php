<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatMessage;

class ApiController extends Controller
{
    function messagesByChatId($chat_id){
        $messages = ChatMessage::where('chat_id', $chat_id)->get();
        $chat = Chat::find($chat_id);
        $members = ChatMember::
        join('users', 'chat_members.user_id', '=', 'users.id')
        ->where('chat_id', $chat_id)->where('user_id', '!=', auth()->user()->id)->get();
        $user_id = auth()->user()->id;

        return compact('messages', 'chat', 'members', 'user_id');
    }
}
