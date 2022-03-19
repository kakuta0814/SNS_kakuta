@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'profile']) !!}

@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach


{{ Form::label('ユーザー名') }}
{{ Form::text('username',$auth->username,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',$auth->mail,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('更新') }}


{!! Form::close() !!}


@endsection
