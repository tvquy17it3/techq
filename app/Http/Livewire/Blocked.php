<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Blocked extends Component
{
    use WithPagination;
    public $search = '';
    public $userIdRemote = null;
    public $email = null;

    public function render()
    {
        if ($this->search !=null) {
            $users =  User::withTrashed()->whereHas('roles', function($q){
                $q->whereNotIn('slug', ['admin']);
            })->where('name', 'like','%'.$this->search.'%')->simplePaginate(20);
            return view('livewire.block-users',['users' => $users]);
        }

        $users =  User::onlyTrashed()->simplePaginate(20);
        return view('livewire.block-users',['users' => $users]);
    }

    public function edit($id)
    {
        // dd($id);
    }

    
    public function confirmUserRestore($user_id, $email)
    {
        $this->userIdRemote = $user_id;
        $this->email=$email;
        $this->dispatchBrowserEvent('show-restore-modal');
    }

    public function restore()
    {
        User::withTrashed()->where('id', $this->userIdRemote)->restore();
        $this->dispatchBrowserEvent('hide-restore-modal',['message'=>'Đã khôi phục tài khoản: '.$this->email]);
    }

    public function confirmUserRemoved($user_id, $email)
    {
        $this->userIdRemote = $user_id;
        $this->email=$email;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        User::withTrashed()->where('id', $this->userIdRemote)->forceDelete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã xoá tài khoản: '.$this->email]);
    }
}
