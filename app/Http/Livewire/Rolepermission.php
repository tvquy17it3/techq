<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Role;

class Rolepermission extends Component
{
    public function render()
    {
        $roles = Role::All();
        return view('livewire.role-permission',['roles'=>$roles]);
    }
}
