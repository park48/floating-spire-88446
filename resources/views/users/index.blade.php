@extends('layouts.default')

@section('title', 'team2.com ユーザー一覧')

{{--
@section('title')
team.com
@endsection
--}}

@section('content')
    <h1>
      ユーザー一覧
    </h1>
    <ul>
      @forelse ($users as $user)
        <li>
          <a >{{$user->id}}</a>
          <a href="#">{{$user->name}}</a>
          <a href="#">{{$user->email}}</a>
          <a href="#" class="edit">[Edit]</a>
          <a href="#" class="del" data-id="{{ $user->id }}">[x]</a>
          <form method="user" action="{{ url('/posts', $user->id) }}"
            id="form_{{ $user->id }}">
             {{ csrf_field() }}
             {{ method_field('delete') }}
          </form>
        </li>
      @empty
      <li>No users yet</li>
      @endforelse
    </ul>
    <script src="/js/main.js"></script>
@endsection
