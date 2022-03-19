<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //


    //public function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'post' => 'required|string|min:1|max:200',

    //     ]);
    // }


    // public function create(array $data)
    // {
    //     return User::create([
    //         'user_id' => Auth::id(),
    //         'post' => $data['post'],
    //     ]);

    // }

         public function create(Request $request)
     {
         $post = $request->input('post');
         \DB::table('posts')->insert([
             'user_id' => Auth::id(),
             'post' => $post
         ]);
         return redirect('posts.index');
     }





    public function index(){
        // if($request->isMethod('post')){
        //     $data = $request->input();

        //     // $validator =$this->validator($data);

        //     // if ($validator->fails()) {
        //     //     return redirect('posts.index')
        //     //     ->withErrors($validator)
        //     //     ->withInput();
        //     // }

        //     $this->create($data);

        //     return redirect('/top');
        // }
        return view('posts.index');
    }





}
