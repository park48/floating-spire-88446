@extends('layouts.default')

@section('title', 'team.com   ToDoリスト')

@@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <br>
        <div class="text-center">
          <p>サーバー側のエラーで正常な処理が行なえません。</p>
          <a href="{{ url('/') }}" class="btn">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
