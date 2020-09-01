<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Image;
use App\Post;

class ImageController extends Controller
{


  public function upload(Request $request,Post $post)
  {
      $this->validate($request, [
          'file' => [
              // 必須
              'required',
              // アップロードされたファイルであること
              'file',
              // 画像ファイルであること
              'image',
              // MIMEタイプを指定
              'mimes:jpeg,png',
          ]
      ]);

      if ($request->file('file')->isValid([])) {
          $path = $request->file->store('public');

          $file_name = basename($path);
          $new_image_data = new Image();
          $new_image_data->post_id = $post->id;
          $new_image_data->file_name = $file_name;

          $new_image_data->save();

          return redirect('posts/{post}/edit');
      } else {
          return redirect()
              ->back()
              ->withInput()
              ->withErrors();
      }
  }

  public function destroy(Post $post,Image $image){
    $image->delete();
    return redirect()->back();
  }

  // public function input()
  // {
  //     return view('image.input');
  // }

  // public function output() {
  //     $user_id = Auth::id();
  //     $user_images = Image::whereUser_id($user_id)->get();
  //     return view('image.output', ['user_images' => $user_images]);
  // }
}
