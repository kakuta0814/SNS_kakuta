

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }} "></script>
    <script src="{{ asset('js/app.js') }} "></script>
    <script src="{{ asset('js/script.js') }} "></script>

    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="16x16" type="image/png" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32" type="image/png" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48" type="image/png" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('favicon.ico') }}" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <div class="header-icon">
                <div class="div"><a href="/top"><img  class="top-logo" src="{{ asset('images/atlas.png') }}"></a></div>

            </div>


            <div id="head-right">

                    <!-- <p class="nav-open"></p> -->





                    <div>
                        <img class="menu-icon" src="{{ asset('storage/user_images/' .auth()->user()->images )}}">
                    </div>

            </div>

            <!-- <nav class="accordion-menu">
                <ul>
                    <li class="nav-item"><a href="/top">ホーム</a></li>
                    <li class="nav-item"><a href="/profile">プロフィール</a></li>
                    <li class="nav-item"><a href="/logout">ログアウト</a></li>
                </ul>
            </nav> -->


        </div>

        <div id="accordion" class="accordion-container">
                        <h4 class="accordion-title js-accordion-title">{{ auth()->user()->username }}さん</h4>
                        <div class="accordion-content">
                            <a href="/top"><div class="nav-item">HOME</div></a>
                            <a href="/profile"><div class="nav-item">プロフィール</div></a>
                            <a href="/logout"><div class="nav-item nav-bottom">ログアウト</div></a>
                        </div><!--/.accordion-content-->


        </div><!--/#accordion-->



    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ auth()->user()->username }}さんの</p>


                <div class="flex-box">
                    <p>フォロー数</p>
                    <p class="count">{{ \App\Follow::where('following_id', Auth::id())->count() }}人</p>
                </div>


                <!-- <div class="blue-btn">
                    <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                </div> -->


                <div class="follow-btn">
                    <a href="/follow-list">
                    <div class="blue-btn">
                        <div>
                            <p class="btn">フォローリスト</p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="flex-box">
                    <p>フォロワー数</p>
                    <p class="count">{{ \App\Follow::where('followed_id', Auth::id())->count() }}人</p>
                </div>

                <!-- <div class="blue-btn">
                    <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                </div> -->

                <div class="follower-btn">
                    <a href="/follower-list">
                        <div class="blue-btn">
                            <div>
                                <p class="btn">フォロワーリスト</p>
                            </div>
                        </div>
                    </a>
                </div>


            </div>

            <div class="search-area">
                <a href="/search">
                    <div class="blue-btn">
                        <div>
                            <p class="btn">ユーザー検索</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
