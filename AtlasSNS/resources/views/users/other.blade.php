@extends('layouts.login')

@section('content')

 <img src="{{ asset('storage/user_images/' .$user->images )}}" class="rounded-circle" width="100" height="100">

{{ $user->username }}

自己紹介
{{ $user->bio }}<br>

ツイート数
{{$tweet_count}}<br>
フォロー数
{{$follow_count}}<br>
フォロワー数
{{$follower_count}}<br>




@endsection
