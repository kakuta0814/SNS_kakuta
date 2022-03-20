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
        $post = $request->input();

        $validate = Validator::make($post, [
            'post' => 'required|string|min:2|max:200',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }


         \DB::table('posts')->insert([
             'user_id' => Auth::id(),
             'post' => $post['post']
         ]);
         return redirect('top');
    }


    public function index(){
        return view('posts.index');
    }





}
