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
        $posts=  Post::unpublished()->where('title', 'like','%'.$this->search.'%')->orderBy('id', 'desc')->simplePaginate(15);
        return view('livewire.post-unpublished',['posts' => $posts]);
    }

    public function edit($id)
    {
        return redirect()->route('edit_post_ad', $id);
    }

    public function publish($postID,$title){
        $post = Post::findOrFail($postID);
        $post->published = true;
        $post->save();
        $this->dispatchBrowserEvent('published',['message'=>'Đã xuất bản bài viết: '.$title]);
    }
}
