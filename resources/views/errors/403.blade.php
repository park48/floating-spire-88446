@extends('layouts.default')

@section('title', 'team.com   ToDoリスト')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <br>
        <div class="text-center">
          <p>こちらのページにアクセスする権限がありません。</p>
          <br>
          <a href="{{ url('/') }}" class="btn">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
