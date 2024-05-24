<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServerEmail;

class ServerEmailController extends Controller
{
    public function verifyServerNotification(){
        return ServerEmail::all();
    }
}
