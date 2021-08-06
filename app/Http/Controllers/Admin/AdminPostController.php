<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
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
        $data = $request->only('title','category_id','thumbnail', 'body');
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $data['category_id'][0];
        $post = Post::create($data);
        if (!$post->save())
        {
            abort(500, 'Error');
        }
        return redirect()->route('edit_post_ad', $post->id)->with('success', 'Tạo bài viết thành công!');
    }

    public function edit(Post $post)
    {
        // dd($post);
        $categories = Category::All();
        return view('admin.edit-post', compact('post'),compact('categories'));
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $data = $request->only('title','category_id','thumbnail', 'body');
        $data['category_id'] = $data['category_id'][0];
        $post->fill($data)->save();
    
        return back()->with('success', 'Cập nhật bài viết!');
    }

    public function publish(Post $post)
    {
        $post->published = true;
        $post->save();
        return back()->with('success', 'Xuất bản thành công!');
    }

    public function unpublish(Post $post)
    {
        $post->published = false;
        $post->save();
        return back()->with('success', 'Xuất ẩn bài viết!');
    }





}
