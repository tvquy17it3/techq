<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\Post\PostRepositoryInterface;

class Postun extends Component
{
    use WithPagination;
    public $search = '';
    public $postIdRemote = null;
    public $title = null;

    public function render(PostRepositoryInterface $postRepo)
    {
        $posts=  $postRepo->search_post_unpublish($this->search)->simplePaginate(15);
        return view('livewire.post-unpublished',['posts' => $posts]);
    }

    public function confirmPostRemoved($postID,$title)
    {
        $this->postIdRemote = $postID;
        $this->title=$title;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deletePost(PostRepositoryInterface $postRepo)
    {
        $rs = $postRepo->delete($this->postIdRemote);
        if (!$rs) {
            $this->noti('noti-error','Đã có lỗi xảy ra!');
            $this->noti('hide-delete-modal','');
        }else{
            $this->noti('hide-delete-modal','Đã xoá bài viết: '.$this->title);
        }
    }

    public function edit_post($id)
    {
        return redirect()->route('edit_post_ad', $id);
    }

    public function publish(Post $postID,$title,PostRepositoryInterface $postRepo){
        $rs = $postRepo->publish($postID);

        if (!$rs) {
            $this->noti('noti-error','Đã có lỗi xảy ra!');
        }else{
            $this->noti('published','Đã xuất bản bài viết: '.$title);
        }
    }

    public function noti($noti,$message)
    {
        $this->dispatchBrowserEvent($noti,['message'=>$message]);
    }
}
