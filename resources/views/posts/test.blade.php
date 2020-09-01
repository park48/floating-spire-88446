@extends('layouts.default')

@section('title', 'team.com   テストページ')

@section('content')
  <!-- <p class="text-center"><img src="/logo.png" class="logo"></p> -->
  <div class="jumbotron">
    <!-- <div class="container"> -->
     <h1>Team.com</h1>
     <h2>映像制作情報共有サイト</h2>
     <p class="btn btn-primary" href="#" role="button">詳しくはこちら »</p>
    <!-- </div> -->
  </div>

      <div class="row o-3column">
        <div class="col-md-4">
          <h2>３カラム見出しテキスト</h2>
          <p>
            <img src="/jumbotron2.jpg" class="column-image">
          </p>
            テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
        </div>
        <div class="col-md-4">
          <h2>３カラム見出しテキスト</h2>
          <p>
            <img src="/jumbotron2.jpg" class="column-image">
          </p>
            テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
        </div>
        <div class="col-md-4">
          <h2>３カラム見出しテキスト</h2>
          <p>
            <img src="/jumbotron2.jpg" class="column-image">
          </p>
            テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
        </div>
      </div>
      <!-- <div id="gmap"></div> -->
      <div id="gmap3"></div>
      <!-- <div id="map-canvas" >マップ2</div> -->
      <div class="menu-bar">
        <span class="menu-bar-title">投稿一覧</span>
        <a href="{{ url('/posts/create')}}" class="posts-menu">新規投稿</a>
      </div>
        <ul>
          @forelse ($posts as $post)
            <!-- <li> -->
              <div class="posts-box">
                <li><div class="posts-title">
                  <a href="{{ action('PostsController@show',$post) }}">名前:{{$post->title}}</a>
                </div>
                <span class="posts-buttons">
                  <a href="{{ action('PostsController@edit',$post) }}" class="edit">[編集]</a>
                  <a href="#" class="del" data-id="{{ $post->id }}">[削除]</a>
                                      <!-- ↑data-idは form_の中身のIDと合わせる  -->
                  <form method="post" action="{{ url('/posts', $post->id) }}"
                    id="form_{{ $post->id }}">
                    <!-- id=は、jsでsubmiti(送信)したい場合につける。 -->
                     {{ csrf_field() }}
                     {{ method_field('delete') }}
                  </form>
                </span><li/>
                  <br>
                <li><div class="posts-title">
                  <a>住所:{{$post->address}}</a>
                </div></li>
                  <br>
                <li><div class="posts-body">詳細:{!! nl2br(e($post->body)) !!}</div></li>
                <li><div class="posts-title">
                  <a href="#"> 投稿者:{{App\User::find($post->user_id)->name}}</a>
                </div></li>
                  <br>
              </div>
            @empty
            <li>投稿はまだありません。</li>
            @endforelse

        </ul>
    <script src="/js/main.js"></script>


@endsection
