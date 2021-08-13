<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserRepository implements UserRepositoryInterface
{
   public function findById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update_roleUser($request)
    {
        $validator = Validator::make($request->input(), array(
            'id_user' => 'required',
            'checkbox' => 'required|array',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $roleAdmin = Role::where('slug', 'admin')->pluck("id")->first();
        if (!Auth::user()->isSuperAdmin() && in_array($roleAdmin,$request->checkbox)) {
            return response()->json([
                'error'    => true,
                'messages' => ["Bạn không có quyền thiết lập admin!"],
            ], 422);
        }

        $user = User::findOrFail($request->id_user);
        $rs = $user->roles()->sync($request->checkbox);
        return $rs;
    }


    public function update_permissions($request,$role)
    {
        $permission = $role->permissions;
        foreach($role->permissions as $key => $v){
            if($request->check_list){
                in_array($key,$request->check_list) ? $permission[$key]=true : $permission[$key]=false;
            }else{
                $permission[$key]=false;
            }
        }
        $role->permissions=$permission;
        $rs = $role->save();
        return $rs;
    }
}
