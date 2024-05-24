<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index(){
        $posts = User::join('posts', 'users.id', '=', 'posts.id_user')
            ->select('users.*', 'users.id as id_user', 'posts.*')
            ->orderByDesc('posts.id')
            ->get();

        return view('feed', ['posts' => $posts]);
    }
}
