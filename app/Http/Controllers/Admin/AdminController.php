<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Models\Role;
use App\Models\ReportPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Storage;
use File;
use Validator;

class AdminController extends Controller
{

    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    public function index()
    {

        // $users = User::with(['posts' => function ($query) {
        //     $query->where('id','>','50');
        // }])->get();

        // dd($users);


        $posts = Post::with(['author','categories'])->get();

        // $users = User::with('roles')->paginate(100);
        // foreach($users as $value){
        //     print_r($value->roles);
        // }

        return view('admin.test',compact('posts'));


        // $users =  User::whereHas('roles', function($q){
        //     $q->whereNotIn('slug', ['admin']);
            
        // })->get();

        // foreach ($users as $user)
        // {
        //     $role= $user->roles[0];
        //     $user->role=  $role->permissions;
        //     $user->slug=  "Tên: ".$role->name.", ".$role->slug;
        // }
        // return view('admin.index',['users' => $users]);
    }

    public function load_more_posts(Request $request )
    {
        
        if ($request->id) {

            $posts = Post::with(['author','categories'], function($q){
                $q->where('published','=', 0);
            })->where('id','<',$request->id)->orderBy('id', 'desc')->take(5)->get();

        }else{

            $posts = Post::with(['author','categories'], function($q){
                $q->where('published','=', 0); 
            })->orderBy('id', 'desc')->take(5)->get();
        }
        

        $list_posts = "";

        if (!$posts->isEmpty()) {
            foreach($posts as $value){
                $list_posts .= "
                    <tr>
                        <th scope='row'>$value->id</th>
                        <td>$value->title</td>
                        <td>".$value->author->email."</td>
                        <td>".$value->author->name."</td>
                        <td>".$value->categories->name."</td>
                        <td>$value->created_at</td>
                        <td>$value->updated_at</td>
                  </tr>
                ";
            }

            $load_more = "<button class='btn btn-primary' data-id='".$value->id."' id='btn_load_more'>Load more</button>";
            return response()->json([
                'id' => $request->id,
                'error' => false,
                'list_posts'  => $list_posts,
                'load_more' => $load_more,
            ], 200);
        }else{
            $load_more = "<button class='btn btn-primary'>Null</button>";
            return response()->json([
                'id' => $request->id,
                'error' => false,
                'load_more' => $load_more,
            ], 200);
        }

        
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
        $rs = $this->userRepo->update_permissions($request,$role);

        if (!$rs) {
            return redirect()->back()->withErrors(['Cannot update permission!']);
        }
        return redirect()->back()->with('success', 'Permissions updated!');
    }


    public function update_role_user(Request $request)
    {
        $rs = $this->userRepo->update_roleUser($request);
        if (!$rs) {
            return response()->json([
                'error'    => true,
                'messages' => ["Đã có lỗi xảy ra!"],
            ], 422);
        }

        return response()->json([
            'error' => false,
            'id_user'  => $request->id_user,
            'checkbox'=>$request->checkbox,
        ], 200);
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