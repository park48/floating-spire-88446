@extends('layouts.default')

@section('title', 'team.com マイページ')

{{--
@section('title')
team.com
@endsection
--}}

@section('content')

  <div class="container">
    <br>
    <div class="mypage-title">マイページ</div>
    @if(!empty($user))
    <table class="maypage-table  table table-striped table-hover">
    <thead>
    <tr>
        <th></th>
        <!-- <th>ID</th> -->
        <th>名前</th>
        <th>メールアドレス</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <tr>
        <td>
            <div>
            @if(!empty($user->thumbnail))
            <img src="/storage/user/{{ $user->thumbnail }}" class="thumbnail">
            @endif
            </div>
        </td>
        <!-- <td>{{ $user->id }}</td> -->
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
        </td>
        </tr>
    </tbody>
    </table>
    @endif
      <a href="{{ url('/') }}" class="alert-link">戻る</a>
      <br>
      <br>
      <br>

      <div class="menu-bar">
        <span class="menu-bar-title">あなたの投稿</span>
        <a href="{{ url('/posts/create')}}" class="posts-menu">新規投稿</a>
      </div>
      @forelse ($posts as $post)
        <div class="posts-box">
          <div class="row p-2column">
            <div class="col-sm-5">
              <p class="post-image">
                @if($post->has('images'))
                    <img class="main-image" src="data:image/jpeg;base64,{{$post->binary}}" >
                @else
                  no images
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
                        <td width="40" height="55">住所</td>
                        <td width="auto" height="auto">：</td>
                        <td width="auto" height="auto">{{$post->address}}</td>
                      </tr>

                      <tr class="posts-body" valign="top">
                        <td width="auto" height="55">詳細</td>
                        <td width="auto" height="auto">：</td>
                        <td width="auto" height="auto">{!! nl2br(e($post->body)) !!}</td>
                      </tr>

                  </table>
                  <br>
                  <div class="posts-user">

                    <a href="#">投稿者:{{App\User::find($post->user_id)->name}}</a>
                  </div>

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
  </div>


    <!-- <script src="/js/main.js"></script> -->
@endsection
