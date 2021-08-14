<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;


class Postpublished extends Component
{
    use WithPagination;
    public $search = '';
    public $postIdRemote = null;
    public $title = null;
    
    public function render(PostRepositoryInterface $postRepo)
    {
        $posts = $postRepo->search_post_published($this->search)->simplePaginate(15);
        return view('livewire.post-published',['posts' => $posts]);
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
            $this->noti('hide-delete-modal','Error');
        }else{
            $this->noti('hide-delete-modal','Đã xoá bài viết: '.$this->title);
        }
    }

    public function edit($id)
    {
        return redirect()->route('edit_post_ad', $id);
    }

    public function unpublish(PostRepositoryInterface $postRepo,Post $postID,$title){
        $rs = $postRepo->unpublish($postID);

        if (!$rs) {
            $this->noti('noti-error','Đã có lỗi xảy ra!');
        }else{
            $this->noti('unpublished','Đã ẩn bài viết: '.$title);
        }
    }

    public function noti($noti,$message)
    {
        $this->dispatchBrowserEvent($noti,['message'=>$message]);
    }
}
