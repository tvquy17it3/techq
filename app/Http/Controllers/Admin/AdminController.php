<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Storage;
use File;

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

    

    public function testGate()
    {
        if(Gate::allows('is_admin')){
            dd(Auth::user()->name);
        }
        abort(403);
    }

    public function analyticUser()
    {

       return view('admin.analytic-users');
    }

    public function testUpload()
    {
        $disk = Storage::disk('google');
        $exists = $disk->exists('test.txt');
        dd($exists);
        if ($exists) {
            echo "Exits";
        }else{
            $disk->put('test.txt','tran van quy 17it3');
            dd('true');
        }
        
    }

    public function list()
    {
        $dir = "/";
        $rec = false;
        $contents = collect(Storage::disk('google')->listContents($dir,$rec));
        return $contents;

    }

    public function role_permission()
    {
        return view('admin.role-permission');
    }
}
