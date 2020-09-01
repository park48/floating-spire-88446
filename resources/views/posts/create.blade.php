@extends('layouts.default')

@section('title','新規投稿')

@section('content')
<div class="width-90">
  <br>
<span class="menu-bar-title">新規投稿</span>
<a href="{{ url('/') }}" class="posts-menu">戻る</a>
<form class="post-form" method="post" action="{{ url('/posts')}}"  enctype="multipart/form-data">
   {{ csrf_field() }}  <!-- /*不正な投稿を防ぐための対策（CSRF:laravelに入って  -->
  <p>
    名前
      <input type="text"  name="title" placeholder="名前を入力して下さい。" value="{{ old('title') }}">
        @if ($errors->has('title'))
          <span class="error">{{ $errors->first('title') }}</span>
        @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
  </p>
  <p>
    住所
      <input type="text" name="address" placeholder="住所を入力して下さい。" value="{{ old('address') }}">
        @if ($errors->has('address'))
          <span class="error">{{ $errors->first('address') }}</span>
        @endif
  </p>
  <p>
    詳細
      <textarea name="body" placeholder="詳細を入力して下さい。">{{ old('body') }}</textarea>
        @if ($errors->has('body'))
          <span class="error">{{ $errors->first('body') }}</span>
        @endif
  </p>
  <p>
      <div class="form-group">
        <label>投稿する画像を選んでください(※複数選択可)</label>
        <br>
        <input type="file" id="file" name="files[][image]" class="form-control" multiple>
        <!-- <input type="file" id="file" name="images[]" class="form-control col-sm-4" multiple> -->
      </div>
      @if ($errors->has('file'))
        <span class="error">{{ $errors->first('file') }}</span>
      @endif
      <!-- <div class="form-group">
        <button type="submit" class="btn btn-primary">アップロード</button>
      </div> -->
      <br>
      <input class="form-button" type="submit" value="投稿する">
  </p>
</form>
</div>
@endsection
