@extends('layouts.default')

@section('title','New Post')

@section('content')
<h1>
  <a href="{{ url('/') }}" class="posts-menu">投稿一覧へ</a>
  新規投稿
</h1>
<form method="post" action="{{ url('/posts')}}">
   {{ csrf_field() }}  <!-- /*不正な投稿を防ぐための対策（CSRF:laravelに入って  -->
  <p>
    <input type="text"  name="title" placeholder="タイトルを入力して下さい。" value="{{ old('title') }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
     @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
  </p>
  <p>
    <textarea name="body" placeholder="投稿内容を入力して下さい。">{{ old('body') }}</textarea>
    @if ($errors->has('body'))
    <span class="error">{{ $errors->first('body') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="投稿">
  </p>
</form>
@endsection
