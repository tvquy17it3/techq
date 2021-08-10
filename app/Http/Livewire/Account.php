<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;

class Account extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $search = '';
    public $userId = null;
    public $email = null;
    public $selection=[];
    public $roles=[];
    public $checked =[];
    public $paginate= 10;


    public function __construct()
    {
        $this->roles= Role::All();
    }

    protected $rules = [
        'name' => 'required|min:6',
        'role' => 'required',
    ];
    // https://laravel-livewire.com/docs/2.x/input-validation
    public function render()
    {
        $this->authorize('user.view');
        if ($this->search !=null) {
            
            $users =  User::whereHas('roles', function($q){
                $q->whereNotIn('slug', ['admin']);
            })->search(trim($this->search))->simplePaginate($this->paginate);
            return view('livewire.account',['users' => $users]);
        }

        $users =  User::whereHas('roles', function($q){
            $q->whereNotIn('slug', ['admin']);
        })->orderBy('id', 'ASC')->simplePaginate($this->paginate);
        return view('livewire.account',['users' => $users]);
    }

    public function edit($user_id)
    {
        $this->userId = $user_id;
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function confirmEdit()
    {
        $this->dispatchBrowserEvent('hide-edit-modal',['message'=>'Đã edit tài khoản: ']);
    }

    public function confirmUserRemoved($user_id, $email)
    {
        $this->userId = $user_id;
        $this->email=$email;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        User::findOrFail($this->userId)->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã khoá tài khoản: '.$this->email]);
    }

    public function isChecked($user_id)
    {
        return in_array($user_id, $this->checked);
    }
    public function emptyChecked()
    {
        $this->checked = [];
    }

    public function blockChecked()
    {
        $result = User::WhereKey($this->checked)->delete();

        if ( $result == true ) {
            $this->dispatchBrowserEvent('noti',['message'=> 'Đã khóa các tài khoản!']);
        }else{
            $this->dispatchBrowserEvent('noti-error',['message'=> 'Đã có lỗi xảy ra!']);
        }
        $this->checked = [];
    }
}
