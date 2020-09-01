@extends('layouts.default')

@section('title','Edit Post')

@section('content')
<h1>
  <a href="{{ url('/') }}" class="header-menu">戻る</a>
  投稿を編集する
</h1>
<form method="post" action="{{ url('/posts',$post->id) }}">
   {{ csrf_field() }}  <!-- 不正な投稿を防ぐための対策（CSRF:laravelに標準で入ってる) -->
   {{ method_field('patch') }}  <!-- ルーティングでパッチメソッドを使うために書く  -->
  <p>
    <input type="text"  name="title" placeholder="enter title" value="{{ old('title',$post->title) }}">
    @if ($errors->has('title'))                               <!--old titleがなければ、$post->titleを入れる。  -->
    <span class="error">{{ $errors->first('title') }}</span>
    @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
  </p>
  <p>
    <textarea name="body" placeholder="enter body">{{ old('body',$post->body) }}</textarea>
    @if ($errors->has('body'))
    <span class="error">{{ $errors->first('body') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Update">
  </p>

</form>
@endsection
