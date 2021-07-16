<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Account extends Component
{
    use WithPagination;
    public $search = '';
    public $userIdRemote = null;
    public $email = null;

    public function render()
    {
        if ($this->search !=null) {
            $users =  User::whereHas('roles', function($q){
                $q->whereNotIn('slug', ['admin']);
            })->where('name', 'like','%'.$this->search.'%')->simplePaginate(20);
            return view('livewire.account',['users' => $users]);
        }

        $users =  User::whereHas('roles', function($q){
            $q->whereNotIn('slug', ['admin']);
        })->orderBy('id', 'ASC')->simplePaginate(20);
        return view('livewire.account',['users' => $users]);
    }

    public function edit($id)
    {
        // dd($id);
    }

    public function confirmUserRemoved($user_id, $email)
    {
        $this->userIdRemote = $user_id;
        $this->email=$email;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        User::findOrFail($this->userIdRemote)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã khoá tài khoản: '.$this->email]);
    }
}
