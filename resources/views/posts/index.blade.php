@extends('layouts.default')

@section('title', 'team.com')

{{--
@section('title')
投稿一覧
@endsection
--}}

@section('content')
  <!-- <p class="text-center"><img src="/logo.png" class="logo"></p> -->
  <div class="jumbotron">
    <!-- <div class="container"> -->
     <h1>Team.com</h1>
     <h2>映像制作情報共有サイト</h2>
     <a class="btn btn-primary" href="{{ url('/about') }}" role="button">詳しくはこちら »</a>
    <!-- </div> -->
  </div>
    <div class="container-800">
      <div class="search-menu">
        <!-- <a class="search-menu-title"></a> -->
        <form action="{{ url('/posts/search') }}" method="GET">
          <a><input class="search-box"type="text" name="keyword" ></a>
          <a><input type="submit" value="検索"></a>
        </form>
      </div>
      <div class="menu-bar">
        <a class="menu-bar-title">投稿一覧</a>
        <a href="{{ url('/posts/create')}}" class="posts-menu">新規投稿</a>
      </div>

          @forelse ($posts as $post)
            <div class="posts-box">
              <div class="row p-2column">
                <div class="col-sm-5">
                  <p class="post-image">
                    @isset($post->path)
                        <img class="main-image" src="data:image/jpeg;base64,{{$post->binary}}" >
                    @else
                        <!-- <img class="no-image" src="/noimage.png"> -->
                        <img class="no-image" >
                        <!-- <img class="no-image" src="data:image/png;base64,{{base64_encode(file_get_contents(noimage.png))}}"> -->
                    @endif
                  </p>
                </div>
                <div class="col-sm-7">
                    <span class="post-text">
                    @auth
                      @if(Auth::user()->id == $post->user_id)
                        <div class="posts-buttons">
                          <a href="{{ action('PostsController@edit',$post) }}" class="edit">[編集]</a>
                            <a href="#" class="del" data-id="{{ $post->id }}">[削除]</a>
                                                <!-- ↑data-idは form_の中身のIDと合わせる  -->
                              <form method="post" action="{{ url('/posts', $post->id) }}"
                                id="form_{{ $post->id }}">
                                <!-- id=は、jsでsubmiti(送信)したい場合につける。 -->
                                 {{ csrf_field() }}
                                 {{ method_field('delete') }}
                              </form>
                        </div>
                      @endif
                    @endauth
                      <a href="{{ action('PostsController@show',$post) }}">{{$post->title}}</a>
                      <table class="posts-table" border="0">
                      		<tr class="posts-address" valign="top">
                      			<td width="40" height="45">住所</td>
                      			<td width="auto" height="auto">：</td>
                      			<td width="auto" height="auto">{{$post->address}}</td>
                      		</tr>
                      		<tr >
                      			<td class="detail" width="auto" height="45">詳細</td>
                            <td class="detail" width="auto" height="auto">：</td>
                      			<td class="detail" width="auto" height="auto">{!! nl2br(e($post->body)) !!}</td>
                      		</tr>

                          <!-- <tr class="posts-user" valign="top">
                      			<td width="auto" height="55"></td>
                            <td width="auto" height="auto"></td>
                      			<td width="auto" height="auto">
                              <a href="#"> 投稿者:{{App\User::find($post->user_id)->name}}</a>
                            </td>
                      		</tr> -->

                      		<!-- <tr class="posts-body" valign="top">
                      			<td width="auto" height="55">投稿者</td>
                      			<td width="auto" height="auto">:{{App\User::find($post->user_id)->name}}</td>
                      		</tr> -->
                      </table>
                      <br>
                      <br>
                      <div class="posts-user">
                        <a >投稿者:{{App\User::find($post->user_id)->name}}</a>
                      </div>
                      <!-- <br>

                        <ul>
                            <li>
                              <div class="posts-title">
                                <a href="{{ action('PostsController@show',$post) }}">{{$post->title}}</a>
                              </div>
                            </li>
                              <br>
                              <br>
                            <li>
                              <div class="posts-address">
                                <a>住所:{{$post->address}}</a>
                              </div>
                            </li>
                              <br>
                            <li>
                              <div class="posts-body">詳細:{!! nl2br(e($post->body)) !!}</div>
                            </li>
                            <li>
                              <div class="posts-user">
                                <a href="#"> 投稿者:{{App\User::find($post->user_id)->name}}</a>
                              </div>
                            </li>
                        </ul> -->
                    </span>
                  </div>
                      <br>
              </div>
            </div>
          @empty
          <ul>
            <li>投稿はまだありません。</li>
          </ul>
          @endforelse
    </div>
    <script src="/js/delete.js"></script>


@endsection
