<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile(){

        $auth = Auth::user();

        return view('users.profile',[ 'auth' => $auth ]);
    }

    public function profile_update(Request $request){

        // $user = $request->input();

        // $validate = Validator::make($user, [
        //     'username' => 'required|string|min:2|max:12',
        //     'mail' => 'required|string|email|min:5|max:40|unique:users',
        //     'password' => 'string|min:8|max:20|confirmed',
        //     'password_confirmation' => 'required|string|min:8|max: 20',
        //     'bio' => 'string|max:150',
        //     'images' => 'mimes:jpg,png,bmp,gif,svg',
        // ]);

        // if ($validate->fails()) {
        //     return back()->withErrors($validate)->withInput();
        // }

        $id = Auth::id();

        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_password = $request->input('password');
        $up_bio = $request->input('bio');
        $up_images = $request->input('images');

        \DB::table('users')
            ->where('id', $id)
            ->update(
                ['username' => $up_username],
                ['mail' => $up_mail],
                ['password' => $up_password],
                ['bio' => $up_bio],
                ['images' => $up_images],

            );

        return view('posts.index');
    }

    public function search(){
        return view('users.search');
    }
}
