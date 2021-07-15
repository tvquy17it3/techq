<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users =  User::whereHas('roles', function($q){
            $q->whereNotIn('slug', ['admin']);
            
        })->get();

        foreach ($users as $user)
        {
            $role= $user->roles[0];
            $user->role=  $role->permissions;
            $user->slug=  "Tên: ".$role->name.", ".$role->slug;
        }
        // dd($users);
        return view('admin.index',['users' => $users]);
    }

    public function all_account()
    {
        // $users =  User::whereHas('roles', function($q){
        //     $q->whereNotIn('slug', ['admin']);
            
        // })->simplePaginate(2);return view('admin.accounts',['userss' => $users]);
        return view('admin.accounts');
    }

    public function blocked()
    {
        dd(true);
    }

    public function chua_duyet()
    {
        $posts = Post::unpublished()->simplePaginate(2);
        return view('admin.post-unpublished',['posts' => $posts]);
    }
}
