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
                    'password' => $up_password,
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
        return view('users.search', ['all_users' => $all_users]);
    }
}
