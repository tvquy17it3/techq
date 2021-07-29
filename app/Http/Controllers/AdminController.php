<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        return view('admin.accounts',['typeAccount'=>'all-accounts']);
    }

    public function blocked()
    {
        return view('admin.accounts',['typeAccount'=>'blocked']);
    }

    public function chua_duyet()
    {
        // $posts = Post::unpublished()->simplePaginate(2);,['posts' => $posts]
        return view('admin.post-unpublished');
    }

    public function testGate()
    {
        if(Gate::allows('is_admin')){
            dd(Auth::user()->name);
        }
        abort(403);
    }
}
