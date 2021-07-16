<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Postun extends Component
{
    use WithPagination;
    public $search = '';
    public $postIdRemote = null;
    public $title = null;
    

    public function confirmPostRemoved($postID,$title)
    {
        $this->postIdRemote = $postID;
        $this->title=$title;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deletePost()
    {
        Post::findOrFail($this->postIdRemote)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã xoá bài viết: '.$this->title]);
    }
    public function render()
    {
        $posts = Post::unpublished()->simplePaginate(15);
        return view('livewire.post-unpublished',['posts' => $posts]);
    }
}
