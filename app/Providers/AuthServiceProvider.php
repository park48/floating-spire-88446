<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Folder; // ★ 追加
use App\User; // ★ 追加
use App\Post; // ★ 追加
use App\Policies\FolderPolicy; // ★ 追加
use App\Policies\PostPolicy; // ★ 追加


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Folder::class => FolderPolicy::class,
        // Folder モデルに対する処理への認可には FolderPolicy ポリシーを使用する、という意味
        Post::class => PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
