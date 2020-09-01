@extends('layouts.default')

@section('title','team.com 新規登録')

@section('content')
<h1>
  <a href="{{ url('/') }}" class="header-menu">HOME</a>
  新規登録
</h1>
<div class="container">
  <form method="post" action="{{ url('/users')}}">
     {{ csrf_field() }}  <!-- /*不正な投稿を防ぐための対策（CSRF:laravelに入って  -->
    <h3>ユーザー名</h3>
    <p>
      <input type="text"  name="name"  value="{{ old('name') }}">
      @if ($errors->has('name'))
      <span class="error">{{ $errors->first('name') }}</span>
       @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
    </p>
    <h3>メールアドレス</h3>
    <p>
      <input type="text"  name="email"  value="{{ old('email') }}">
      @if ($errors->has('email'))
      <span class="error">{{ $errors->first('email') }}</span>
      @endif
    </p>
    <p>
      <input type="submit" value="登録">
    </p>
  </form>
</div>
@endsection
