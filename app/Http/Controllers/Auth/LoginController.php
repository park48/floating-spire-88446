<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google 認証後の処理
        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認
        $gUser = Socialite::driver('google')->stateless()->user();
        // dd($gUser);
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/');
    }

    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }




    public function redirectToTwitter()
    {
        // Twitter へのリダイレクト
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        // Twitter 認証後の処理
        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認
        $twUser = Socialite::driver('twitter')->stateless()->user();
        // dd($twUser);
        // email が合致するユーザーを取得
        $user = User::where('email', $twUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByTwitter($twUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/');
    }

    public function createUserByTwitter($twUser)
    {
        $user = User::create([
            'name'     => $twUser->name,
            'email'    => $twUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }




    public function redirectToFacebook()
    {
        // Facebook へのリダイレクト
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        // Facebook 認証後の処理
        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認
        $fbUser = Socialite::driver('facebook')->stateless()->user();
        // dd($fbUser);
        // email が合致するユーザーを取得
        $user = User::where('email', $fbUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByFacebook($fbUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/');
    }

    public function createUserByFacebook($fbUser)
    {
        $user = User::create([
            'name'     => $fbUser->name,
            'email'    => $fbUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }


}
