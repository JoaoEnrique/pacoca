<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{

    // VIEW das notificações
    public function notification(){
        $notifications = $this->getNotification(auth()->user()->id);
        return view('notifications', ['notifications' => $notifications]);
    }
    
    public function getNotification($id_user){
        $notifications = Notification::where('id_user', $id_user)->orderBy('created_at', 'desc')->get();

        return $notifications;
    }

    public function haveNotification($id_user){
        $notifications = Notification::where('id_user', $id_user)->where('read', 0)->get()->count();

        return $notifications;
    }

    public function viewNotification($id_user){
        $notifications = Notification::where('id_user', $id_user)->get();

        foreach($notifications as $notification){
            $notification->update([
                'read' => 1,
            ]);
        }
    }

    public function opeNotification(Request $request){
        $notifications = Notification::where('id', $request->id_notification)->get();

        foreach($notifications as $notification){
            $notification->update([
                'opened' => 1,
            ]);
        }

        return response()->json(['message' => 'openSuccess']);
    }
}
