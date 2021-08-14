<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class AdminPostController extends Controller
{
    private $userRepo;
    private $postRepo;

    public function __construct(UserRepositoryInterface $userRepo,PostRepositoryInterface $postRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo =$postRepo;
    }


    public function chua_duyet()
    {
        return view('admin.post-unpublished');
    }

    public function da_duyet()
    {
        return view('admin.post-published');
    }

    public function create_post()
    {

        $cat = Category::All();

        return view('admin.create-post',['categories'=>$cat]);
    }

    public function uploadImage(Request $request) {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|max:5000',
        ]);

        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());
            return $message;
        }


        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
       
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
       
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
       
            //filename to store
            $filenametostore = $request->user()->id.'_'.$filename.'_'.time().'.'.$extension;
       
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
     
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
              
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }  


    public function store(StorePostRequest $request)
    {
       $post = $this->postRepo->store($request);
        if (!$post)
        {
            abort(500, 'Error');
        }
        return redirect()->route('edit_post_ad', $post->id)->with('success', 'Tạo bài viết thành công!');
    }

    public function edit(Post $post)
    {
        $categories = Category::All();
        $report_status = $this->postRepo->status_report_post($post->id);
        return view('admin.edit-post',['report'=> $report_status,'post'=>$post,'categories'=>$categories]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $rs = $this->postRepo->update($post,$request);
        return $rs ? back()->with('success', 'Cập nhật bài viết!') : back()->withErrors(['message1'=>'Đã có lỗi xãy ra!']);
    }


    public function publish(Post $post)
    {
        $rs = $this->postRepo->publish($post);
        return $rs ? back()->with('success', 'Xuất bản thành công!') : back()->withErrors(['message1'=>'Đã có lỗi xãy ra!']);
    }

    public function unpublish(Post $post)
    {
        $rs = $this->postRepo->unpublish($post);
        return $rs ? back()->with('success', 'Xuất ẩn bài viết!') : back()->withErrors(['message1'=>'Đã có lỗi xãy ra!']);
    }
}
