@extends('layouts.default')

@section('title',$post->title)

@section('content')
<h1>
  <a href="{{ url('/') }}" class="posts-menu">投稿一覧へ</a>
  {{ $post->title }}
</h1>

<p>{!! nl2br(e($post->body)) !!}</p>

<h2>コメント</h2>
<ul>
  @forelse ($post->comments as $comment)
  <!-- <li><a href="/posts/{{ $post->id }}">{{$post->title}}</a></li> -->
  <!-- <li><a href="{{ url('/posts',$post->id) }}">{{$post->title}}</a></li> -->
  <li>
    {{ $comment->body }}
    <a href="#" class="del" data-id="{{ $comment->id }}">[x]</a>
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
    <input type="submit" value="投稿">
  </p>

</form>
<script src="/js/main.js"></script>
@endsection
