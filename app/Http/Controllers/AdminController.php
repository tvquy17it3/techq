<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            $user->slug=  $role->slug;
        }
        return view('admin.index',['users' => $users]);
    }
}
