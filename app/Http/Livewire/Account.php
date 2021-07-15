<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Account extends Component
{
    public $search = '';
    public $userIdRemote = null;
    public function render()
    {
        if ($this->search !=null) {
            $users =  User::whereHas('roles', function($q){
                $q->whereNotIn('slug', ['admins']);
                
            })->where('name', 'like','%'.$this->search.'%')->simplePaginate(20);
            return view('livewire.account',['users' => $users]);
        }

        $users =  User::whereHas('roles', function($q){
            $q->whereNotIn('slug', ['admin']);
            
        })->simplePaginate(20);
        return view('livewire.account',['users' => $users]);
    }

    public function edit($id)
    {
        // dd($id);
    }

    public function confirmUserRemoved($user_id)
    {
        $this->userIdRemote = $user_id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $users = User::findOrFail($this->userIdRemote)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã xoá!!']);
    }
}
