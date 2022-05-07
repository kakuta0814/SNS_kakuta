@extends('layouts.login')

@section('content')





                    @if (isset( $errors ))
                    <div class="error-message">
                        <div class="error-inner">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </div>
                    </div>
                    @endif

                    {!! Form::open(['url' => 'top']) !!}
                        @csrf
                            <div class="flex-box tweet-form">
                                <div class="tweet-icon">
                                    <img class="rounded-circle"  width="50" height="50" src="{{ asset('storage/user_images/' .auth()->user()->images )}}">
                                </div>

                                {{ Form::textarea('post',null,['class' => 'input form-space', 'placeholder' => '投稿内容を入力してください。', 'cols'=>'70' , 'rows' => '5']) }}

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                                    <div class="tweet-test">
                                        {!! Form::button('<i class="far fa-paper-plane test-icon"></i>', ['class' => "btn", 'type' => 'submit' ]) !!}
                                    </div>


                            </div>




                    {!! Form::close() !!}





@foreach ($all_posts as $post)
    <div class="tweet">
        @if(auth()->user()->isFollowing($post->user_id) || auth()->user()->id == $post->user_id)
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

            @if(auth()->user()->id == $post->user_id)
                    <div class="my-tweet">

                        <a href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                            <div class="tweet-delete">
                                <i class="fas fa-trash-alt delete-icon"></i>
                            </div>
                        </a>

                        <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{$post->id}}">
                            <div class="tweet-update">
                                <i class="fas fa-edit update-icon"></i>
                            </div>
                        </a>

                    </div>
                @endif

        </div>
        @endif


    </div>
@endforeach

            <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="/update" method="post">
               @csrf
                <textarea name="post" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="submit" value="更新">

           </form>
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>

@endsection
