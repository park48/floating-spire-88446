
@extends('layouts.default')

@section('title','編集画面')

@section('content')
<div class="container">
    <br>
  <span class="menu-bar-title">編集画面</span>
  <a href="{{ url('/') }}" class="posts-menu">戻る</a>
    <br>
  <form class="post-form" method="post" action="{{ url('/posts',$post->id) }}" enctype="multipart/form-data">
     {{ csrf_field() }}  <!-- 不正な投稿を防ぐための対策（CSRF:laravelに標準で入ってる) -->
     {{ method_field('patch') }}  <!-- ルーティングでパッチメソッドを使うために書く  -->
    <p>
      名前
        <input type="text"  name="title" placeholder="名前を入力して下さい。" value="{{ old('title',$post->title) }}">
          @if ($errors->has('title'))                               <!--old titleがなければ、$post->titleを入れる。  -->
            <span class="error">{{ $errors->first('title') }}</span>
          @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
    </p>
    <p>
      住所
        <input type="text"  name="address" placeholder="住所を入力して下さい。" value="{{ old('address',$post->address) }}">
          @if ($errors->has('address'))                               <!--old addressがなければ、$post->addressを入れる。  -->
            <span class="error">{{ $errors->first('address') }}</span>
          @endif     <!-- first()とすることで１つ目のエラーのみ表示できる  -->
    </p>
    <p>
      詳細
        <textarea name="body" placeholder="詳細を入力して下さい。">{{ old('body',$post->body) }}</textarea>
          @if ($errors->has('body'))
            <span class="error">{{ $errors->first('body') }}</span>
          @endif
    </p>
    <p>
        <div class="form-group">
          <label>投稿する画像を選んでください(※複数選択可)</label>
          <br>
          <input type="file" id="file" name="files[][image]" class="form-control" multiple>
          <!-- <input type="file" id="file" name="file" class="form-control col-sm-4" value="{{ old('path',$post->path) }}"> -->
        </div>
        @if ($errors->has('file'))
          <span class="error">{{ $errors->first('file') }}</span>
        @endif
        <!-- <div class="form-group">
          <button type="submit" class="btn btn-primary">アップロード</button>
        </div> -->
        <br>
      @if(Auth::user()->id == $post->user_id)
        <input class="form-button" type="submit" value="投稿する">
      @endif
    </p>
  </form>
  <table class="images-table" border="1">
        @forelse ($post->images as $image)
              <tr>
                <td max-width="40"  max-height="40"><img class="post-images" src="data:image/png;base64,{{$image->binary}}" ></td>
                <td width="80%"><a class="post-images-title">{{ $image->file_name }}</a></td>
                <td width="40">
                  <!-- <div class="posts-buttons"> -->
                  @if(Auth::user()->id == $post->user_id)
                    <a href="#" class="del" data-id="{{ $image->id }}">[削除]</a>
                  @endif
                      <form method="post"
                       action="{{ action('ImageController@destroy', [$post, $image]) }}"
                       id="form_{{ $image->id }}">
                         {{ csrf_field() }}
                         {{ method_field('delete') }}
                      </form>
                  <!-- </div> -->
                </td>
              </tr>
        @empty
        <tr>
          <td>画像はまだありません。</td>
        </tr>
        @endforelse
  </table>

  <script src="/js/delete.js"></script>

</div>

@endsection
