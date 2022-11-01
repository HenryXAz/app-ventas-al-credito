<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Credit;
use Livewire\WithPagination;
use Carbon\Carbon;

class CustomerReports extends Component
{
    use WithPagination;

    public $report = "1";


    public function updatingReport()
    {
      $this->resetPage();
    }


    public function render()
    {   
        $date = Carbon::today("America/Guatemala");
        
        $startWeek = $date->startOfWeek()->toDateString();
        $endWeek = $date->endOfWeek()->toDateString();
        

        $credits = [];

        if($this->report === "1") {
          $credits = Credit::where("status", "=", "1")
          ->whereIn("id", function($query) use($startWeek, $endWeek)
          {
            $query->select("id_credit")
              ->from("payments")
              ->whereBetween("payment_date", [$startWeek, $endWeek]);
          })->paginate(10);
        } else if($this->report === "2") {
          $credits = Credit::where("status", "=", "1")
            ->whereNotIn("id", function($query) use($startWeek, $endWeek)
          {
            $query->select("id_credit")
              ->from("payments")
              ->whereBetween("payment_date", [$startWeek, $endWeek]);
          })->paginate(10);


        } else if($this->report === "3") {
          $credits = Credit::where("status", "=", "1")
            ->whereIn("id", function($query) use($startWeek, $endWeek)
          {
            $query->select("id_credit")
              ->from("payments")
              ->where("status", "=", "1")
              ->where("payment_date", "<", Carbon::today("America/Guatemala"));
          })->paginate(10);
        }


        return view('livewire.customer-reports.customer-reports', [
          "credits" => $credits,
        ]);        
    }

}
