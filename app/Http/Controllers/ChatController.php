<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Notification;

class ChatController extends Controller
{
    public function index(){
        $chats = Chat::
        join('chat_members', 'chat_members.chat_id', '=', 'chats.id')
        ->join('users', 'chat_members.user_id', '=', 'users.id')
        ->select('chats.id as chat_id')
        ->where('chat_members.user_id', auth()->user()->id)->get();

        $members = ChatMember::
        join('users', 'chat_members.user_id', '=', 'users.id')
        ->where('user_id', '!=', auth()->user()->id)->get();

        $chat_id = !empty($_GET['chat_id']) ? $_GET['chat_id'] : 0;
        return view('user.chats', compact('chats', 'members', 'chat_id'));
    }

    public function newChat($id){

        $userId = $id;
        $user = auth()->user();

        // Encontrar todos os chats em que o usuário atual e o usuário com o ID $id estão envolvidos
        $chats = ChatMember::where('user_id', $userId)
            ->whereIn('chat_id', function ($query) use ($user) {
                $query->select('chat_id')
                    ->from('chat_members')
                    ->where('user_id', $user->id);
            })
            ->get();

        if(isset($chats[0])){
            $chat_id = $chats[0]->chat_id;
        }
        $exist = $chats->isNotEmpty();

        if(!$exist){
            $chat = Chat::create([
                'name' => 'chat'
            ]);

            ChatMember::create([
                'chat_id' => $chat->id,
                'user_id' => $id
            ]);

            ChatMember::create([
                'chat_id' => $chat->id,
                'user_id' => auth()->user()->id
            ]);

            $chat_id = $chat->id;
        }

        $chats = Chat::
        join('chat_members', 'chat_members.chat_id', '=', 'chats.id')
        ->join('users', 'chat_members.user_id', '=', 'users.id')
        ->select('chats.id as chat_id')
        ->where('chat_members.user_id', auth()->user()->id)->get();

        $members = ChatMember::
        join('users', 'chat_members.user_id', '=', 'users.id')
        ->where('user_id', '!=', auth()->user()->id)->get();

        return view('user.chats', compact('chats', 'members', 'chat_id'));
    }

    public function opeChats($user_name){
        return view('user.chats', ['user_name' => $user_name]);
    }

    public function sendMessage(Request $request){
        // Validação da entrada
        $validated = $request->validate([
            'chat_id' => 'required|integer',
            'text' => 'required|string|max:255',
        ]);

        // Criação da mensagem
        $message = ChatMessage::create([
            'chat_id' => $validated['chat_id'],
            'user_id' => auth()->user()->id,
            'text' => $validated['text']
        ]);

        $chat_message = ChatMember::where('chat_id', $validated['chat_id'])->where('user_id', '!=', auth()->user()->id)->first();
        $user = User::find($chat_message->user_id);

        // NOTIFICAÇÃO
        $id_user = $user->id;

        if(auth()->user()->img_account){
            $img = auth()->user()->img_account;
        }else{
            $img = '../img/img-account.png';
        }

        $text = auth()->user()->name . " te enviou uma mensagem no pv";
        $link1 = "/" . auth()->user()->user_name;
        $link2 = "/post/" . $request->id_post;

        $this->setNotification($id_user, $img, $text, $link1, $link2);

        // Variáveis para serem passadas
        $titulo = auth()->user()->user_name . ' te enviou uma mensagem no pv';
        $link = "https://pacoca.onrender.com/chat?chat_id=" . $validated['chat_id'];
        $texto = auth()->user()->user_name . ' te enviou uma mensagem no pv';
        $to = $user->email;

        $url = 'https://crud-odontologia.000webhostapp.com/email?' .
            'titulo=' . urlencode(utf8_encode($titulo)) .
            '&link=' . urlencode(utf8_encode($link)) .
            '&texto=' . urlencode(utf8_encode($texto)) .
            '&to=' . $user->email;

        // CHAMA API DO 000WEBHOST PARA ENVIAR EMAIL
        $response = file_get_contents($url);

        // $this->setNotification($user_post->id_user, $img, $text, $link1, $link2);

        return response()->json(
            [
                'ok' => '1'
            ]
        );

        // Retornar resposta JSON
        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso!',
            'data' => $message
        ]);
    }

    public function setNotification($id_user, $img_notification, $text, $link1, $link2){
        // $id_user, $text, $link1, $link2, $read
        $read = 0;
        $opened = 0;

        $notifications = Notification::create([
            'id_user' => $id_user,
            'img_notification' => $img_notification,
            'text' => $text,
            'link1' => $link1,
            'link2' => $link2,
            'opened' => 0,
            'read' => $read,
        ]);

        return $notifications;
    }
}
