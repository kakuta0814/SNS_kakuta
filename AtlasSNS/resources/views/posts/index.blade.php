@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

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


@endsection
