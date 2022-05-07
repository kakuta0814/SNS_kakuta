<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }



    public function getUsers(Int $user_id)
    {
        return $this->Where('id', $user_id)->get();
    }





    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }


    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->exists();

    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        $auth_id = auth()->user()->id;
        return $this->followers()->where('following_id', $user_id)->exists();
    }


    // public static $editNameRules = array(

    // 'username' => 'required|string|min:2|max:12'

    // );

    // public static $editEmailRules = array(

    // 'mail' => 'required|string|email|min:5|max:40|unique:users'

    // );

    // public static $editPasswordRules = array(

    // 'password' => 'string|min:8|max:20|confirmed'

    // );

    // public static $editPassconRules = array(

    // 'password_confirmation' => 'string|min:8|max: 20'

    // );

    // public static $editBioRules = array(

    // 'bio' => 'max:150'

    // );




    }
