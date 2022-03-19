<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    //



    public function create(Request $request)
     {
        $post = $request->input('post');

    $validate = Validator::make($post->all(), [
        'post' => 'required|string|min:2|max:200',
    ]);

    if ($validate->fails()) {
        return redirect()->route("top")->withErrors($validate->messages());
    }


         \DB::table('posts')->insert([
             'user_id' => Auth::id(),
             'post' => $post
         ]);
         return redirect('top');
    }


    public function index(){
        return view('posts.index');
    }





}
