<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){

        $auth = Auth::user();

        return view('users.profile',[ 'auth' => $auth ]);
    }
    public function profile_update(){
        return view('posts.index');
    }


    public function search(){
        return view('users.search');
    }
}
