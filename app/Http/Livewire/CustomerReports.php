<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Credit;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerReports extends Component
{
    public $report = "1";
    public $customers;

    public function render()
    {   
        $date = Carbon::parse(date("Y-m-d"));

        $weekNumber = $date->weekNumberInMonth;
        $start = $date->startOfWeek()->toDateString();
        $end = $date->endOfWeek()->toDateString();
        
        $customers = [];

        if($this->report === "2") {
            $payments = Payment::whereNotBetween("payment_date", [$start, $end])
                ->get()->unique("id_credit")->unique("id_customer");

            $this->getCustomers($payments);    
        } 
        else if($this->report === "1") {
            $payments = Payment::whereBetween("payment_date", [$start,$end])
                ->get();
            $this->getCustomers($payments);
        }
        else if($this->report === "3") {
            $payments = Payment::where("payment_date", "<", date("Y-m-d"))->get();
            $this->getCustomers($payments);
        }   

        return view('livewire.customer-reports.customer-reports', [
            "payments" => $payments, 
            "customers" => $customers,
        ]);
    }

    public function getCustomers($payments)
    {
        $this->customers = [];
        foreach($payments as $payment) {
            array_push($this->customers, $payment->credits->first()->customer->first());
        }
    }
}
