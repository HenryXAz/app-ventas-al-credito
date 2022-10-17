<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;

class Profits extends Component
{
    public $payments;
    public $year = "0";
    public $month = "0";
    public $capital = 0;
    public $interests = 0;

    public function render()
    {
        if($this->year === "0" || $this->month === "0") {
            $this->year = date("Y");
            $this->month = date("m");

            $this->payments = Payment::where("status", "=", "2")
            ->whereMonth("payment_day", "=", date("m"))
            ->whereYear("payment_day", "=", date("Y"))
            ->get();    
        } else {
            $this->payments = Payment::where("status", "=", "2")
            ->whereMonth("payment_day", "=", $this->month)
            ->whereYear("payment_day", "=", $this->year)
            ->get();
        }
        

        $payments = $this->payments;

        $this->getCapital();
        $this->getInterests();

        return view('livewire.profits.profits', ["payments" => $payments]);
    }

    public function getCapital()
    {
        $payments = $this->payments->pluck("capital")->toArray();
        
        $this->capital = array_reduce($payments, function($previus, $current){
            return $previus += $current;
        },0);

        round($this->capital,2);
    }

    public function getInterests()
    {
        $payments = $this->payments->pluck("interest")->toArray();

        $this->interests = array_reduce($payments, function($previus, $current){
            return $previus += $current;
        },0);

        round($this->interests,2);
    }

    public function getMonth($month)
    {
        switch($month) {
            case "1": return "enero"; break;
            case "2": return "febrero"; break;
            case "3": return "marzo"; break;
            case "4": return "abril"; break;
            case "5": return "mayo"; break;
            case "6": return "junio"; break;
            case "7": return "julio"; break;
            case "8": return "agosto"; break;
            case "9": return "septiembre"; break;
            case "10": return "octubre"; break;
            case "11": return "noviembre"; break;
            case "12": return "diciembre"; break;
        }
    }

}
