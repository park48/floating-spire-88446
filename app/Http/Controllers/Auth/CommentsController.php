<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //Postクラスの変数$postが使える様になる。
use App\Comment;  //Commentクラスの変数$commentが使える様になる。

class CommentsController extends Controller
{
    public function store(Request $request, Post $post){
                          //引数の指定（Request型の変数$request）
        $this->validate($request,['body' => 'required']);
        $comment = new Comment(['body' => $request->body]);
        $post->comments()->save($comment); //postに紐付いた形でコメントをsaveする
        return redirect()->action('PostsController@show',$post);
    }

    public function destroy(Post $post,Comment $comment){
      $comment->delete();
      return redirect()->back(); //元のページにもどるだけなら、->back()でいい。
    }
}
