<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostsController@index');
// Route::get('/test', 'PostsController@test');
Route::get('/about', 'PostsController@about');
Route::get('/posts/{post}' , 'PostsController@show')
      ->where('post','[0-9]+')->name('posts.show');
Route::get('/posts/search' , 'PostsController@search')
      ->name('posts.search');





      Route::group(['middleware' => 'auth'], function() {

Route::get('/posts/create' , 'PostsController@create');
            //where('post','[0-9]+') postは数字しか許可しないことで、
            //次の行のcreateが実行される.
Route::post('/posts' , 'PostsController@store');

    // Route::group(['middleware' => 'can:view,post'], function() {

Route::get('/posts/{post}/edit' , 'PostsController@edit');
Route::patch('/posts/{post}' , 'PostsController@update');
Route::delete('/posts/{post}' , 'PostsController@destroy');
Route::delete('/posts/{post}/edit/images/{image}' , 'ImageController@destroy');

  // });

Route::post('/posts/{post}/comments' , 'CommentsController@store');
Route::delete('/posts/{post}/comments/{comment}' , 'CommentsController@destroy');
// {post},{comment}  {}で各々のidをわたす。

Route::get('/users' , 'UsersController@index')->name('users.index');
Route::get('/users/signup' , 'UsersController@create');
// Route::post('/users' , 'UsersController@store');
Route::get('/users/{user}' , 'UsersController@show')->name('users.show');

  // 下の↓画像のupload機能は練習のためにつけたので、機能はしてない。
// Route::get('/upload', 'ImageController@input');
// Route::post('/posts/{post}/upload', 'ImageController@upload');
// Route::get('/output', 'ImageController@output');




    Route::get('/home', 'PostsController@index');
  // Route::get('/home', 'HomeController@index')->name('home');

  // todoリストの作成             canは folder(URLの変数初分)をviewすることを許可する。
  // Route::group(['middleware' => 'can:view,folder'], function() {

    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');
    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
  // });
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
});

Auth::routes();

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('//login/google/callback', 'Auth\LoginController@handleGoogleCallback');

// Auth Google
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('//login/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('login/google/logout', 'Auth\LoginController@getLogout');


Route::get('login/twitter', 'Auth\LoginController@redirectToTwitter');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterCallback');
Route::get('login/twitter/logout', 'Auth\LoginController@getLogout');


// Auth Facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::get('login/facebook/logout', 'Auth\LoginController@getLogout');
// public function auth()
//     {
//         // Authentication Routes...
//         $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
//         $this->post('login', 'Auth\LoginController@login');
//         $this->post('logout', 'Auth\LoginController@logout')->name('logout');
//
//         // Registration Routes...
//         $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//         $this->post('register', 'Auth\RegisterController@register');
//
//         // Password Reset Routes...
//         $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//         $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//         $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//         $this->post('password/reset', 'Auth\ResetPasswordController@reset');
//     }
