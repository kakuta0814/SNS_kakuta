@extends('layouts.login')

@section('content')



<div class="flex-box icon-area">



        <div class="icon-margin flex-box">


            <div class="icon-space">
                        <img src="{{ asset('storage/user_images/' .$user->images )}}" class="rounded-circle" width="50" height="50">
            </div>

            <div class="profile-text">

                <div class="profile-name flex-box">
                    <div class="profile-name1">neme</div>
                    <div class="profile-name2">{{ $user->username }}</div>

                </div>

                <div class="profile-bio flex-box">
                    <div class="profile-bio1">bio</div>
                    <div class="profile-bio2">{{ $user->bio }}</div>

                </div>

            </div>

            <div class="follow-btn">
                @if (auth()->user()->isFollowing($user->id))
                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>
                @else
                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary">フォローする</button>
                    </form>
                @endif
            </div>

        </div>

    </div>




@foreach ($all_posts as $post)

        @if($user->id == $post->user_id)
        <div class="tweet">
            <div class="flex-box">
                <div class="tweet-icon">
                    <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50">
                </div>

                <div class="tweet-data">

                    <div class="flex-box">
                        <div class="tweet-username">
                            <P>{{ $post->username }}</P>
                        </div>

                    </div>

                    <div>{{ $post->post }}</div>




                </div>
            </div>

            <div>
                <div class="tweet-time">
                    <div><p>{{ $post->created_at }}</p></div>
                </div>



            </div>
        </div>
        @endif

@endforeach



@endsection
