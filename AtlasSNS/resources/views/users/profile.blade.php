@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'profile','enctype' => 'multipart/form-data']) !!}
<!-- {{ csrf_field() }} -->

@if ($errors->any())
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
@endif


{{ Form::label('ユーザー名') }}
{{ Form::text('username',$auth->username,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',$auth->mail,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::label('自己紹介') }}
{{ Form::text('bio',$auth->bio,['class' => 'input']) }}

{{ Form::label('画像') }}
{{Form::file('images', ['class'=>'custom-file-input','id'=>'fileImage'])}}


{{ Form::submit('更新') }}


{!! Form::close() !!}


@endsection
