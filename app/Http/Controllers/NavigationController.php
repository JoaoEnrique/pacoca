<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function login(){
        return view('user.login');
    }

    public function register(){
        return view('user.register');
    }

    public function edit(){
        return view('user.edit');
    }

    public function page_not_found(){
        return view('errors.404');
    }

    public function search(){
        return view('user.search_mobile');
    }

    public function verify_email(){
        if(auth()->check() && !auth()->user()->hasVerifiedEmail())
            return view('auth.verify');

        return redirect('/');
    }

    function verified_email(){
        return redirect('/')->with('success', 'Email verificado. Agora você pode fazer publicações, comentar, curtir posts e acessar o chat.');
    }
}
