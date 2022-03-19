<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //



    public function create(Request $request)
     {
         $post = $request->input('post');

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
