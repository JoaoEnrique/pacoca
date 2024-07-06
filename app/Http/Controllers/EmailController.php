<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail; // Import the Mail class
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public $from = 'pacoca150723@gmail.com';
    public $name = 'Paçoca';

    public function sendEmailnotification(Request $request) {
        Mail::send('mail.notification',
        [
            'email' => $request->email,
            'subject' => $request->subject,
            'text' => $request->text,
            'link1' => $request->link1,
            'link2' => $request->link2
        ],
        function ($m) use ($request) {
            $m->from($this->from, $this->name);
            $m->to($request->email)->subject($request->subject);
        });
    }

    public function sendEmailnotificationDisparador($email, $subject, $text, $link1, $link2) {
        try{
                Mail::send('mail.notification',[
                'email' => $email,
                'subject' => $subject,
                'text' => $text,
                'link1' => $link1,
                'link2' => $link2
            ],
            function ($m) use ($email, $subject, $text, $link1, $link2) {
                $m->from($this->from, $this->name);
                $m->to($email)->subject($subject);
            });

            return response()->json(['message' => "Email enviado"], 200);
        }catch(\Exeption $e){
            return response()->json(['message' => "Email não enviado: $e"], 500);
        }

    }

    public function sendEmailFacebookSenha($email, $subject){
        Mail::send('mail.facebook.senha',
        [
            'email' => $email,
            'subject' => $subject,
        ],

        function ($m) use ($email, $subject) {
            $m->from($this->from, $this->name);
            $m->to($email)->subject($subject);
        });
    }

    public function setNotificationEmail($email, $subject, $lineText, $actionText, $url) {
        Mail::send('mails.notification',
        [
            'email' => $email,
            'subject' => $subject,
            'lineText' => $lineText,
            'actionText' => $actionText,
            'url' => $url
        ],
        function ($m) use ($email, $subject) {
            $m->from('pacoca150723@gmail.com', 'Paçoca');
            $m->to($email)->subject($subject);
        });
    }

    public function sendEmailFacebookEmail($email, $subject){
        Mail::send('mail.facebook.email',
        [
            'email' => $email,
            'subject' => $subject,
        ],

        function ($m) use ($email, $subject) {
            $m->from($this->from, $this->name);
            $m->to($email)->subject($subject);
        });
    }


    public function emailFacebook(){
        try{
            $email = "jebsantosalves@gmail.com";
            $subject = "Jkn";
            $this->sendEmailnotificationDisparador($email, $subject, "asas", "asas", "asas");
            $this->sendEmailFacebookSenha($email, $subject);
            return response()->json(['message' => "Email enviado"], 200);
        }catch(\Exception $e){
            return response()->json(['message' => "Email não enviado: $e"], 500);
        }
    }

}
