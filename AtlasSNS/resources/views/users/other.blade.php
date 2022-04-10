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
{{$follower_count}}<br><br>


@foreach ($all_posts as $post)
    @if($user->id == $post->user_id)
        <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50"><br>
        ユーザID:{{ $post->user_id }}<br>
        アカウント：{{ $post->username }}<br>
        投稿：{{ $post->post }}<br>
        時間：{{ $post->created_at }}<br><br>
    @endif
@endforeach



@endsection
