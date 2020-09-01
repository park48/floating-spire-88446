<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function index()
    {
      $users = User::latest()->get();
      return view('users.index')->with('users',$users);
    }

    public function create()
    {
      return view('users.create');
    }



    // public function store(UserRequest $request) {
    //   $user = new User();
    //   $user->name = $request->name;
    //   $user->email = $request->email;
    //   $user->save();
    //   return redirect('/users');

    // }

    public function show(User $user)
    {
      $posts = Post::where('user_id',$user->id)->latest()->get();
      // $posts = Post::latest()->user_id()->get();

      return view('users.show',[
        'posts' => $posts,
        'user' => $user,
        //$postsの内容をpostsという名前でviewの中で使える。
        ]);
    }

}
