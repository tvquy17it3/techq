<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
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
        $roles = Role::All();
        return view('admin.role-permission',['roles'=>$roles]);
    }

    public function permissions(Role $role)
    {
        return view('admin.permission',compact('role'));
    }

    public function update_permissions(Request $request, Role $role)
    {
        $list = $request->check_list;
        $permission = $role->permissions;
        foreach($role->permissions as $key => $v){
            if($list){
                in_array($key,$list) ? $permission[$key]=true : $permission[$key]=false;
            }else{
                $permission[$key]=false;
            }
        }
        $role->permissions=$permission;
        $rs = $role->save();

        if (!$rs) {
            return redirect()->back()->withErrors(['Cannot update permission!']);
        }
        return redirect()->back()->with('success', 'Permissions updated!');
    }
}
//{
// "post.create":true,
// "post.update":true,
// "post.publish":false,
// "user.view":true,
// "user.update":false,
// "role.view":true,
// "role.update":false,
// "admintp.access":true
// }