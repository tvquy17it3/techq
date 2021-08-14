<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\ReportPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\PublishedPost;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    public function findById($id)
    {
        return Post::findOrFail($id);
    }

    public function store($request)
    {
        $data = $request->only('title','category_id','thumbnail', 'body');
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $data['category_id'][0];
        $rs = Post::create($data);
        return $rs;
    }


    public function update($post,$request)
    {
        $data = $request->only('title','category_id','thumbnail', 'body');
        $data['category_id'] = $data['category_id'][0];
        $rs = $post->fill($data)->save();
        return $rs ? true : false;
    }


    public function publish($post)
    {
        DB::beginTransaction();
        try {
                $post->published = true;
                $post->save();
                $report = ReportPost::create([
                    'content' => 'Đã duyệt bài viết',
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                ]);
                DB::commit();
                // event(new PublishedPost($post));
                return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function unpublish($post)
    {
        DB::beginTransaction();
        try {
                $post->published = false;
                $post->save();
                $report = ReportPost::create([
                    'content' => 'Đã ẩn bài viết',
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                ]);
                DB::commit();
                return true;
        } catch (Exception $e) {
                DB::rollback();
                return false;
        }
    }

    public function delete($id){
        $rs = Post::findOrFail($id)->delete();
        return $rs;
    }

    public function search_post_unpublish($keyword){
        $posts = Post::unpublished()->where('title', 'like','%'.$keyword.'%')->orderBy('id', 'desc');
        return $posts;
    }

    public function search_post_published($keyword){
        $posts = Post::published()->where('title', 'like','%'.$keyword.'%')->orderBy('id', 'desc');
        return $posts;
    }

    public function status_report_post($id){
        $rs = ReportPost::where('post_id', '=', $id)->get();
        return $rs;
    }
}