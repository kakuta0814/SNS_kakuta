<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Follow;
use App\Post;

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
        $auth = Auth::user();

        if ($request->file("images") != null) {

            //拡張子付きでファイル名を取得
            $filenameWithExt = $request->file("images")->getClientOriginalName();

            //ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //拡張子を取得
            $extension = $request->file("images")->getClientOriginalExtension();

            //保存のファイル名を構築
            $filenameToStore = $filename."_".time().".".$extension;

            $path = $request->file("images")->storeAs("public/user_images", $filenameToStore);
        }

        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_password = $request->input('password');
        $up_bio = $request->input('bio');




        \DB::table('users')
         ->where('id', $id)
         ->update(
                 [
                    'username' => $up_username,
                    'mail' => $up_mail,
                    'password' => bcrypt($up_password),
                    'bio' => $up_bio,
                    'images' => $filenameToStore,
                 ]
        );


    //     $user = Auth::user();

    //     $form = $request->all();
    //     $id = Auth::id();


    //     $profileImage = $request->file('images');
    //     if ($profileImage != null) {
    //         $form['images'] = $this->saveProfileImage($profileImage, $id); // return file name
    //     }

    //     unset($form['_token']);
    //     unset($form['_method']);
    //     $user->fill($form)->save();

    //     return view('posts.index');
    // }

    // private function saveProfileImage($image, $id) {
    //     // get instance
    //     $img = \Image::make($image);
    //     // resize
    //     $img->fit(100, 100, function($constraint){
    //         $constraint->upsize();
    //     });
    //     // save
    //     $file_name = 'profile_'.$id.'.'.$image->getClientOriginalExtension();
    //     $save_path = 'public/profiles/'.$file_name;
    //     Storage::put($save_path, (string) $img->encode());
    //     // return file name
        return redirect('/profile');
    }



    public function search(User $user){
            $all_users = $user->getAllUsers(auth()->user()->id);
        return view('users.search', ['all_users'  => $all_users]);
    }


    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    public function userdata(User $user, Post $post, Follow $follow ,$userdata)
    {

        $user = User::find($userdata);
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($userdata);
        $is_followed = $login_user->isFollowed($userdata);
        $timelines = $post->getUserTimeLine($userdata);
        $tweet_count = $post->getTweetCount($userdata);
        $follow_count = $follow->getFollowCount($userdata);
        $follower_count = $follow->getFollowerCount($userdata);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('users.other', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'all_posts'  => $all_posts
        ]);
    }

    public function follow_list(User $user){

        // $all_posts = \DB::table('posts')->orderBy('created_at', 'DESC')->get();

        $all_users = $user->getAllUsers(auth()->user()->id);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all_follows = \DB::table('follows')
            ->Where('following_id', Auth::id())
            ->get('followed_id');

        return view('follows.followlist', [
            'all_users'  => $all_users,
            'all_posts'  => $all_posts,
            'all_follows'  => $all_follows,
        ]);
    }

    public function follower_list(User $user){

        $all_users = $user->getAllUsers(auth()->user()->id);

        $all_posts = \DB::table('posts')
            ->select('users.id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $all_follows = \DB::table('follows')
            ->Where('following_id', Auth::id())
            ->get('followed_id');

        return view('follows.followerlist', [
            'all_users'  => $all_users,
            'all_posts'  => $all_posts,
            'all_follows'  => $all_follows,
        ]);
    }




}
