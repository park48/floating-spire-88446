<?php

namespace App\Policies;

use App\Post;
use App\User;


use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Policies\UserPolicy; //追加
use App\Policies; //追加

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user)
    {
        // $user = Auth::user();
        return $user->id === Auth::user()->id;
    }



}
