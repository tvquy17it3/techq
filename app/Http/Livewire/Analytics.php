<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class Analytics extends Component
{
    public $days =[];
    public $counts=[];
    public $CountUsers;
    public $countToday;
    public $now;

    public function __construct()
    {
        $this->CountUsers=User::all()->count();
        $this->now= Carbon::today();
    }

    public function mount()
    {
        $range = Carbon::now()->subDays(60);
        $stats = DB::table('users')
          ->where('created_at', '>=', $range)
          ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
          ->orderBy('created_at', 'ASC')
          ->get([DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
            DB::raw("COUNT(*) as counts")
          ])->all();
        foreach ($stats as $day) {
          $this->days[] = $day->date;
          $this->counts[] = $day->counts;
        }
    }

    public function fectchData()
    {
        $cb = Carbon::today();
        if($cb != $this->now){
            return redirect()->route('analytic-user');
        }
        $this->CountUsers=User::all()->count();
        $stats = User::whereDate('created_at', $cb)
        ->count();
        $this->countToday=$stats;
        $this->counts[count($this->counts)-1]= $stats;
        $this->emit('renderData', $this->counts);

    }

    public function render()
    {
        return view('livewire.analytics');
    }
}
