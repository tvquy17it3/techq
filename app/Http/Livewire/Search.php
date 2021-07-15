<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Search extends Component
{
    public $search = '';
    public function render()
    {
        return view('admin.search', [
            'usersLW' => User::where('name', 'like','%'.$this->search.'%')->get(),
        ]);
    }
}
