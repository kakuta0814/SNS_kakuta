<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Follow;
use App\Post;

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

    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('posts.index');
    }


    public function index(User $user ){

        // $all_posts = \DB::table('posts')->orderBy('created_at', 'DESC')->get();
        // $login_user = auth()->user();

        // $follow_count = $follow->getFollowCount($user->id);
        // $follower_count = $follow->getFollowerCount($user->id);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.id', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all_follows = \DB::table('follows')
            ->Where('following_id', Auth::id())
            ->get('followed_id');
            // dd ($all_follows);

        return view('posts.index', [
            'all_posts'  => $all_posts,
            'all_follows'  => $all_follows,
            // 'follow_count'   => $follow_count,
            // 'follower_count' => $follower_count
        ]);
    }







}
