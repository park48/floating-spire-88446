<?php

namespace App\Policies;

use App\Post;
use App\User;


use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\PostPolicy; //追加
use App\Policies; //追加

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user, Post $post)
    {
        // $user = Auth::user();
        return $user->id === $post->user_id;
    }



}
