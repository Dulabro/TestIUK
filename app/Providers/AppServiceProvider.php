<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('manage-users', function ($user) {
            return $user->hasRole('admin');
        });
       
    
        // $admin = Role::create(['name' => 'admin']);
        // $user = Role::create(['name' => 'user']);
    
        // $createPost = Permission::create(['name' => 'create post']);
        // $editPost = Permission::create(['name' => 'edit post']);
        // $deletePost = Permission::create(['name' => 'delete post']);
    
        // $admin->givePermissionTo([$createPost, $editPost, $deletePost]);
        // $user->givePermissionTo([$createPost]);
    }
}
