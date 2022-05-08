@extends('layouts.logout')

@section('content')



<div class="added-from">

  <div class="added-inner">

    @if (Session::has('username'))
      <p class="added-main">{{ session('username') }}さん</p>
    @endif

    <p class="added-sub">ようこそ！AtlasSNSへ！</p>


    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <a href="/login">
      <div class="home-btn">
        <div>ログイン画面へ</div>
      </div>
    </a>



  </div>

</div>

@endsection
