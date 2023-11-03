<?php

namespace App\Http\Livewire; 

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Profits extends Component
{
    public $start_date = null;
    public $end_date = null;
    public $statistics = null;

    public function mount()
    {
        $this->start_date = \Carbon\Carbon::today('America/Guatemala')->format('Y-m-d');
        $this->end_date = \Carbon\Carbon::today('America/Guatemala')->format('Y-m-d');
    }

    public function render()
    {
        if($this->start_date > $this->end_date) {
            $this->start_date = $this->end_date;
        }

        DB::select('CALL `SP_GET_RECOVERED_CAPITAL_PROFITS_AND_TEN_PERCENT_OF_PROFITS`
        (?,?,@profits, @recovered_capital, @ten_percent_of_profits)', [
            $this->start_date,
            $this->end_date,
        ]);

        $this->statistics = DB::select('SELECT @profits AS `profits`, 
            @recovered_capital AS `recovered_capital`,
            @ten_percent_of_profits AS `ten_percent_of_profits`');
        return view('livewire.profits.profits');
    }
}