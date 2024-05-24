<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail; // Import the Mail class
use Illuminate\Http\Request;

class EmailController extends Controller
{
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
            $m->from('pacoca150723@gmail.com', 'Paçoca');
            $m->to($request->email)->subject($request->subject);
        });
    }

    public function sendEmailnotificationDisparador($email, $subject, $text, $link1, $link2) {
        Mail::send('mail.notification',
        [
            'email' => $email,
            'subject' => $subject,
            'text' => $text,
            'link1' => $link1,
            'link2' => $link2
        ], 
        function ($m) use ($email, $subject, $text, $link1, $link2) {
            $m->from('pacoca150723@gmail.com', 'Paçoca');
            $m->to($email)->subject($subject);
        });
        
    }
    
}
