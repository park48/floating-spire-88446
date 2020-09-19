<?php

namespace App\Http\Controllers;   //名前空間＝ファイルの場所を示す

use Illuminate\Http\Request;  // use 使うクラスの場所を宣言する。
use App\Post;
use App\User;
use App\Image;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PostsController extends Controller
{
      public function index() {
      //$posts = Post::all();
      //$posts = Post::orderBy('created_at','desc')->get();
      $posts = Post::latest()->get(); //最近作られたデータから取得する。
      // $user = User::find($post->user_id)->get(); //最近作られたデータから取得する。
      // $user = User::find(Post::latest()->user_id);
      //dd($posts->toArray());  // dump die 結果を出力してその場で終了してくれる
      //return view('posts.index',['posts'=> $posts]);

      return view('posts.index',[
        'posts' => $posts,
        // 'user' => $user,
        //$postsの内容をpostsという名前でviewの中で使える。
        ]);
      }

      public function about() {

      $posts = Post::latest()->get(); //最近作られたデータから取得する。

      return view('posts.about',[
        'posts' => $posts,
        // 'user' => $user,
                            //$postsの内容をpostsという名前でviewの中で使える。
        ]);
      }
      public function test() {

      $posts = Post::latest()->get(); //最近作られたデータから取得する。

      return view('posts.test',[
        'posts' => $posts,
        // 'user' => $user,
                            //$postsの内容をpostsという名前でviewの中で使える。
        ]);
      }

 // public function show($id){    //Post $postにするとURLからidを取得してくれる
    public function show(Post $post){
      // $post = Post::find($id);
      // $post = Post::findOrFail($id);
      return view('posts.show')->with('post',$post);
          // withの使い方 viewに post という名前で $post を渡す。
    }

    public function create() {
      return view('posts.create');
    }


    public function store(PostRequest $request) {

      $user = Auth::user();
      $nowtime = Carbon::now();
      $post = new Post();

      $post->title = $request->title;
      $post->address = $request->address;
      $post->body = $request->body;
      $post->user_id = $user->id;


      $user->posts()->save($post);
      // $post->save();

      if($request->has('files')){
        if($files=$request->file('files')){
          foreach($files as $file => $e){

          $image = new Image();
          //ファイル名取得
          $image->binary = base64_encode(file_get_contents($e['image']->getRealPath()));
          $filename = $user->id."_".$nowtime."_".$e['image']->getClientOriginalName();
          // storage/app/publicにファイルを保存する
          // $request->file('file')->store('public');
          // Image::make($file)->save(public_path( 'storage/' . $filename ));
          $e['image']->storeAs('public',$filename);
          // $image->post_id = $post->id;
          $image->file_name= $filename;
          $image->path = '/storage/'.$filename;
          $post->path = '/storage/'.$filename;
          $post->binary = base64_encode(file_get_contents($e['image']->getRealPath()));


          $image->post_id = $post->id;
          $post->images()->save($image);
          }
        }
      // if($request->has('images')){
      //   if($files=$request->file('images')){
      //     foreach($files as $file){
      //
      //     $image = new Image();
      //     //ファイル名取得
      //     $filename = $user->id."_".$nowtime."_".$file->getClientOriginalName();
      //     // storage/app/publicにファイルを保存する
      //     // $request->file('file')->store('public');
      //     // Image::make($file)->save(public_path( 'storage/' . $filename ));
      //     $file->storeAs('public',$filename);
      //     // $image->post_id = $post->id;
      //     $image->file_name= $filename;
      //     $image->path = '/storage/'.$filename;
      //     $post->path = '/storage/'.$filename;
      //
      //     }
      //   }



        $user->posts()->save($post);

      }

      return redirect('/');

    }

    public function edit(Post $post) {

      // $images = $post->images()->get();

      return view('posts.edit',[

        'post' => $post,
        'path' => $post->path,
        // 'images' => $images,

        ]);
    }


    public function update(PostRequest $request, Post $post) {

      $user = Auth::user();
      $nowtime = Carbon::now();

      $post->title = $request->title;
      $post->address = $request->address;
      $post->body = $request->body;
      $post->user_id = $user->id;

      $user->posts()->save($post);
      // $post->save();

      if($request->has('files')){
        if($files=$request->file('files')){
          foreach($files as $file => $e){

          $image = new Image();
          //ファイル名取得
          $image->binary = base64_encode(file_get_contents($e['image']->getRealPath()));
          $filename = $user->id."_".$nowtime."_".$e['image']->getClientOriginalName();
          // storage/app/publicにファイルを保存する
          // $request->file('file')->store('public');
          // Image::make($file)->save(public_path( 'storage/' . $filename ));
          $e['image']->storeAs('public',$filename);
          // $image->post_id = $post->id;
          $image->file_name= $filename;
          $image->path = '/storage/'.$filename;
          $post->path = '/storage/'.$filename;
          $post->binary = base64_encode(file_get_contents($e['image']->getRealPath()));

          $image->post_id = $post->id;
          $post->images()->save($image);
          }
        }

        $user->posts()->save($post);

      }
      // if($request->has('files')){
      //   if($files=$request->file('files')){
      //     foreach($files as $file => $e){
      //
      //     $image = new Image();
      //     //ファイル名取得
      //     $filename = $user->id."_".$nowtime."_".$e['image']->getClientOriginalName();
      //     // storage/app/publicにファイルを保存する
      //     // $request->file('file')->store('public');
      //     // Image::make($file)->save(public_path( 'storage/' . $filename ));
      //     $e['image']->storeAs('public',$filename);
      //     // $image->post_id = $post->id;
      //     $image->file_name= $filename;
      //     $image->path = '/storage/'.$filename;
      //     $post->path = '/storage/'.$filename;
      //
      //     $image->post_id = $post->id;
      //     $post->images()->save($image);
      //     }
      //   }
      //
      //   $user->posts()->save($post);
      //
      // }
      return view('posts.show')->with('post',$post);
    }

    public function destroy(Post $post){
      $post->delete();
      return redirect("/");
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhere('address', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('posts.search', compact('posts', 'keyword'));
    }




    protected function validator(array $data)
    {
        return Validator::make($data, [
          'title' => 'required|min:2',
          'address' => 'required',
          'body' => 'required'
        ], [], [
          'title' => '名前',
          'address' => '住所',
          'body' => '詳細',
        ]);
    }


}
