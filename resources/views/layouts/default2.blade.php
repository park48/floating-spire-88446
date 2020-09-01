<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
  <!-- nav barの　css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


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
  <!-- navbarのjs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
      <nav class="navbar navbar-expand-xl navbar-dark bg-dark mt-3 mb-3">
          <a class="navbar-brand header-title" href="{{ url('/')}}">Team.com</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav3" aria-controls="navbarNav3" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav3">
              <ul class="navbar-nav header_menu">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                @auth
                  <li class="nav-item">
                      <a class="nav-link" href="#">{{Auth::user()->name}}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"　onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                  </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                    @if(null !== (Auth::user()->folders()->first()))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tasks.index',['id' => Auth::user()->folders()->first()->id]) }}">ToDoリスト</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('folders.create')}}">ToDoリスト</a>
                        </li>
                    @endif
                  @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register')}}">新規登録</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ url('/login')}}" href="#">ログイン</a>
                        </li>
                  @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/users')}}">ユーザー一覧</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/test')}}">テストページ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
              </ul>
          </div>
      </nav>    </header>
    <div class="header-shadow"></div>
    <div class="container">
      @yield('content')
    </div>
</body>
</html>
