<?php

namespace App\Policies;

use App\Folder;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Policies\FolderPolicy; //追加
use App\Policies; //追加

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    public function view(User $user, Folder $folder)
    {
        // $user = Auth::user();
        return $user->id === $folder->user_id;
    }


}
