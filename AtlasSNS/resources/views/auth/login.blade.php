@extends('layouts.logout')

@section('content')





<div class="logout-from">

  <div class="logout-inner">
    {!! Form::open() !!}

    <p class="white welcome">AtlasSNSへようこそ</p>

    <div class="form">
      {{ Form::label('mail adress') }}
      {{ Form::text('mail',null,['class' => 'input']) }}


    </div>

    <div class="margin-form form">
      {{ Form::label('password') }}
      {{ Form::password('password',['class' => 'input']) }}
    </div>

    <div class="btn-form">
      {{ Form::submit('LOGIN',['class' => 'btn btn-danger']) }}
    </div>



    <div class="white new-user"><a href="/register">新規ユーザーの方はこちら</a></div>

    {!! Form::close() !!}
  </div>
</div>





@endsection
