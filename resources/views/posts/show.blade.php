@extends('layouts.default')

@section('title',$post->title)

@section('content')
<div class="container">
  <div class="show-title">
    {{ $post->title }}
  </div>
  <div class="show-body">
  @if( $post->path )
    <div class="show-image-box">
      <div class="slide-box">
          <ul class="slide">
            @forelse ($post->images as $image)
              <li class="item">
                <a href="#"><img src="data:image/png;base64,{{$image->binary}}" alt=""/></a>
              </li>
            @empty
              写真はまだありません。
            @endforelse
          </ul>
        <div class="slide-navigation">
          @forelse ($post->images as $image)
            <div class="item">
              <figure class="image">
                <img src="data:image/png;base64,{{$image->binary}}" alt=""/>
              </figure>
            </div>
          @empty
            写真はまだありません。
          @endforelse
        </div>
      </div>
    </div>
  @endif
  </div>
      <div class="show-text">
        <div class="show-buttons">
          <a href="{{ action('PostsController@edit',$post) }}" class="show-button">[編集]</a>
          <a href="{{ url('/') }}" class="show-button">[戻る]</a>
        </div>
        <p>詳細:{!! nl2br(e($post->body)) !!}</p>
        <p>住所:<span id="address">{{$post->address}}</span></p>
        <p>投稿者:{{App\User::find($post->user_id)->name}}</p>
      </div>
    @if( $post->address )
      <div class="gmap" id="gmap"></div>
    @endif

  <div class="comment-area">
    <h3>コメント</h3>
    <ul>
      @forelse ($post->comments as $comment)
      <!-- <li><a href="/posts/{{ $post->id }}">{{$post->title}}</a></li> -->
      <!-- <li><a href="{{ url('/posts',$post->id) }}">{{$post->title}}</a></li> -->
      <li>
        {{ $comment->body }}
        <a href="#" class="del" data-id="{{ $comment->id }}">[削除]</a>
        <form method="post"
        action="{{ action('CommentsController@destroy', [$post, $comment]) }}"
        id="form_{{ $comment->id }}">
           {{ csrf_field() }}  <!-- これ何？ -->
           {{ method_field('delete') }}
         </form>
         <!-- action=""は送信先という意味 -->
      </li>
      @empty
      <li>コメントはまだありません。</li>
      @endforelse
    </ul>
    <form method="post" action="{{ action('CommentsController@store',$post) }}">
       {{ csrf_field() }}  <!-- /*不正な投稿を防ぐための対策（CSRF:laravelに入って  -->
      <p>
        <input type="text"  name="body" placeholder="コメントを入力して下さい。" value="{{ old('body') }}">
        @if ($errors->has('body'))
        <span class="error">{{ $errors->first('body') }}</span>
         @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
      </p>
      <p>
        <input type="submit" value="送信">
      </p>
    </form>
  </div>
</div>


  <script src="/js/delete.js"></script>
  <script src="/js/slick.js"></script>
  <script src ="/js/googlemap.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlixYv558muo3Sr4OJShqFCiSZzbrpv3g&callback=initMap" ></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

</div>

@endsection
