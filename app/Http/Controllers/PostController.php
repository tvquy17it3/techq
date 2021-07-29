<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->paginate();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::published()->findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function find_slug($slug)
    {
        $post = Post::published()->where('slug',$slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->only('title', 'body');
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);
        return redirect()->route('edit_post', $post->id)->with('success', 'Tạo bài viết thành công!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $data = $request->only('title', 'body');
        $Slug = Str::slug($data['title']);
        $Check = Post::Checkslug($Slug, $post->id);

        if ($Check) {
            $data['slug'] = $Slug;
            $post->fill($data)->save();
            return back()->with('success', 'Cập nhật thành công!');
        }else{
            return back()->withErrors(['title'=>'Vui lòng chọn tiêu đề khác, Slug đã tồn tại!']);
        }
    }

    public function publish(Post $post)
    {
        $post->published = true;
        $post->save();
        return back()->with('success', 'Xuất bản thành công!');
    }

    public function drafts()
    {
        $postsQuery = Post::unpublished();
        if(Gate::denies('post.draft')) {
            $postsQuery = $postsQuery->where('user_id', Auth::user()->id);
        }
        $posts = $postsQuery->paginate(10);
        return view('posts.drafts', compact('posts'));
    }
}
