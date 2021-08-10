<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Blocked extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $search = '';
    public $paginate= 10;
    public $userIdRemote = null;
    public $email = null;
    public $checked =[];

    

    public function render()
    {
        $this->authorize('user.view');

        if ($this->search !=null) {
            $users =  User::withTrashed()->whereHas('roles', function($q){
                $q->whereNotIn('slug', ['admin']);
            })->search(trim($this->search))->simplePaginate($this->paginate);
            return view('livewire.block-users',['users' => $users]);
        }

        $users =  User::onlyTrashed()->orderBy('id', 'ASC')->simplePaginate($this->paginate);
        return view('livewire.block-users',['users' => $users]);
    }

    public function edit($id)
    {
        // dd($id);
        sleep(2);
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


    public function isChecked($user_id)
    {
        return in_array($user_id, $this->checked);
    }

    public function deleteChecked()
    {
        $result = User::withTrashed()->whereKey($this->checked)->forceDelete();
        if ( $result == true ) {
            $this->dispatchBrowserEvent('noti',['message'=> 'Đã xoá tài khoản']);
        }else{
            $this->dispatchBrowserEvent('noti',['message'=> 'Error']);
        }
        $this->checked = [];
    }
    

    public function restoreChecked()
    {
        $result = User::withTrashed()->whereKey($this->checked)->restore();

        if ( $result == true ) {
            $this->dispatchBrowserEvent('noti',['message'=> 'Đã khôi phục tài khoản!']);
        }else{
            $this->dispatchBrowserEvent('noti-error',['message'=> 'Đã có lỗi xảy ra!']);
        }
        $this->checked = [];
    }

    public function emptyChecked()
    {
        $this->checked = [];
    }

}
