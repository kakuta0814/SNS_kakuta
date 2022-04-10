@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"></div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                    @endif
                    {!! Form::open(['url' => 'top']) !!}



                        @csrf
                        <div class="form-group row">
                            <div class="col-md-10">

                                {{ Form::text('post',null,['class' => 'input']) }}

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-2">
                                {{ Form::submit('投稿') }}
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>



@foreach ($all_posts as $post)
    @if(auth()->user()->isFollowing($post->user_id) || auth()->user()->id == $post->user_id)
    <br>
        <img src="{{ asset('storage/user_images/' .$post->images )}}" class="rounded-circle" width="50" height="50"><br>
        ユーザID:{{ $post->user_id }}<br>
        アカウント：{{ $post->username }}<br>
        投稿：{{ $post->post }}<br>
        時間：{{ $post->created_at }}<br>
    @endif

    @if(auth()->user()->id == $post->user_id)
    <a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">削除</a><br>
    @endif

@endforeach


@endsection
