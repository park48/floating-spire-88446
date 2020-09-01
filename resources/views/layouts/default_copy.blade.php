<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <!--CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootflat/2.0.4/css/bootflat.min.css" />
  <!-- ↑Todoリスト用のcss -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  <!-- slick用のcss -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">


  <!--JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script src ="/js/googlemap.js"></script>
  <!-- <script src ="/js/googlemap3.js"></script> -->
  <!-- <script src ="/js/googlemap2.js"></script> -->
  <!-- ↑apiのjsより先に入れる！ -->
  <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlixYv558muo3Sr4OJShqFCiSZzbrpv3g&callback=mapApiClientReady&getCoordinate&showMap&fAddBaloon" ></script> -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlixYv558muo3Sr4OJShqFCiSZzbrpv3g"></script> -->
  <!-- slick用のjs -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

  <!-- Styles(ローカルの場合、secure_asset=>assetにすること) -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sign_up.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sign_in.css') }}" rel="stylesheet">
  <link href="{{ asset('css/tasks.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('#') }}" rel="stylesheet">
  <link href="{{ asset('css/top.css') }}" rel="stylesheet">
  <link href="{{ asset('css/button.css') }}" rel="stylesheet">
  <link href="{{ asset('css/common.css') }}" rel="stylesheet">
  <link href="{{ asset('css/header.css') }}" rel="stylesheet">
  <link href="{{ asset('css/card_edit.css') }}" rel="stylesheet">
  <link href="{{ asset('css/card_new.css') }}" rel="stylesheet">
  <link href="{{ asset('css/card_show.css') }}" rel="stylesheet">
  <link href="{{ asset('css/list_new.css') }}" rel="stylesheet">
  <link href="{{ asset('css/list_edit.css') }}" rel="stylesheet"> -->

    <!-- awesome fonts -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>
    <header>
      <a href="{{ url('/')}}" class="header-title">
        Team.com
      </a>
        <ul class="header_menu">
          @auth
            <li><a>{{Auth::user()->name}}<a/><li/>
            <li><a class="#" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              ログアウト
            </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            @if(null !== (Auth::user()->folders()->first()))
              <li><a href="{{ route('tasks.index',['id' => Auth::user()->folders()->first()->id]) }}"
                     class="#">
                     ToDoリスト
                 </a></li>
            @else
            <li><a href="{{ route('folders.create')}}" class="#">ToDoリスト</a></li>
            @endif
          @else
            <li><a href="{{ url('/register')}}" class="#">新規登録</a></li>
            <li><a href="{{ url('/login')}}" class="#">ログイン</a></li>
          @endauth
            <li><a href="{{ url('/users')}}" class="#">ユーザー一覧</a></li>
            <li><a href="{{ url('/test')}}" class="#">テストページ</a></li>
        </ul>
    </header>
    <div class="header-shadow"></div>
    <div class="container">
      @yield('content')
    </div>
</body>
</html>
