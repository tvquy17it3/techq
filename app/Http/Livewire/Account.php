<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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
            
            $users =  User::search(trim($this->search))->simplePaginate($this->paginate);
            return view('livewire.account',['users' => $users]);
        }

        $users =  User::orderBy('id', 'ASC')->simplePaginate($this->paginate);
        return view('livewire.account',['users' => $users]);
    }

    public function confirmUserRemoved($user_id, $email)
    {
        $this->userId = $user_id;
        $this->email=$email;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function blockUser()
    {
        $this->authorize('user.update');
        $userC = User::findOrFail($this->userId);
        if ($userC->inRole('admin')) {
            $u =  User::whereHas('roles', function($q){
                $q->whereIn('slug', ['admin']);
            })->count();
            if ($u<=1) {
                $this->dispatchBrowserEvent('hide-modal-noti-error',['message'=>'Không thể khóa tài khoản này, bởi vì chỉ có 1 tài khoản admin!']);
            }else{
                if(Auth::user()->inRole("admin")){
                    $userC->delete();
                    $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã khoá tài khoản: '.$this->email]);
                }else{
                    $this->dispatchBrowserEvent('hide-modal-noti-error',['message'=>'Chỉ có quyền Admin mới có thể khóa tài khoản admin khác!']);
                }
                
            }
        }else{
            $userC->delete();
            $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'Đã khoá tài khoản: '.$this->email]);
        }

        // User::findOrFail($this->userId)->delete();
        
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

    public function deleteChecked()
    {
        $result = User::whereKey($this->checked)->forceDelete();
        if ( $result == true ) {
            $this->dispatchBrowserEvent('noti',['message'=> 'Đã xoá tài khoản']);
        }else{
            $this->dispatchBrowserEvent('noti',['message'=> 'Error']);
        }
        $this->checked = [];
    }
}