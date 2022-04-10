@extends('layouts.login')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($all_users as $user)
                @if (auth()->user()->isFollowed($user->id))
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <a href="{{ route('other',['userdata'=>$user->id]) }}" class="text-secondary">
                                <img src="{{ asset('storage/user_images/' .$user->images )}}" class="rounded-circle" width="50" height="50">
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>

    @foreach ($all_posts as $post)
        @if(auth()->user()->isFollowed($post->user_id))
            <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50"><br>
            ユーザID:{{ $post->user_id }}<br>
            アカウント：{{ $post->username }}<br>
            投稿：{{ $post->post }}<br>
            時間：{{ $post->created_at }}<br><br>
        @endif
    @endforeach

@endsection
