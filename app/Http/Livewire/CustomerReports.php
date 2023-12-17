<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Credit;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Log;

class CustomerReports extends Component
{
    public $startDate, $endDate, $paidCredits, $unpaidCredits, $upcomingPayments;

    public function mount()
    {
        // Establece las fechas iniciales en formato Y-m-d
        $this->startDate = Carbon::today('America/Guatemala')->subDays(7)->format('Y-m-d');
        $this->endDate = Carbon::today('America/Guatemala')->format('Y-m-d');
        $this->refreshData();
    }

    public function updateDateRange()
    {
        // Asegúrate de que las fechas estén en formato Y-m-d
        $this->validate([
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'required|date_format:Y-m-d',
        ]);

        $this->refreshData();
    }

    private function queryCredits($type)
    {
        $query = Credit::query();
        $startDateInstance = Carbon::createFromFormat('Y-m-d', $this->startDate)->startOfDay();
        $endDateInstance = Carbon::createFromFormat('Y-m-d', $this->endDate)->endOfDay();

        switch ($type) {
            case 'paid':
                $query->where('status', '1')->whereHas('payments', function ($query) use ($startDateInstance, $endDateInstance) {
                    $query->where('status', '2')->whereBetween('payment_date', [$startDateInstance, $endDateInstance]);
                });
                break;

            case 'unpaid':
                $query->where('status', '1')->whereDoesntHave('payments', function ($query) use ($startDateInstance, $endDateInstance) {
                    $query->where('status', '1')->whereBetween('payment_date', [$startDateInstance, $endDateInstance]);
                });
                break;

            case 'upcoming':
                $query->where('status', '1')->with(['futurePayments' => function ($query) use ($endDateInstance) {
                    $query->where('payment_date', '>', $endDateInstance);
                }])->whereHas('futurePayments', function ($query) use ($endDateInstance) {
                    $query->where('payment_date', '>', $endDateInstance);
                });
                break;
        }

        Log::info("Query SQL for {$type}: " . $query->toSql());
        return $query->get();
    }

    public function refreshData()
    {
        $this->paidCredits = $this->queryCredits('paid');
        $this->unpaidCredits = $this->queryCredits('unpaid');
        $this->upcomingPayments = $this->queryCredits('upcoming');
    }

    public function render()
    {
        // Convertir las fechas a d/m/Y para mostrarlas en la vista
        $startDateDisplay = Carbon::createFromFormat('Y-m-d', $this->startDate)->format('d/m/Y');
        $endDateDisplay = Carbon::createFromFormat('Y-m-d', $this->endDate)->format('d/m/Y');

        return view('livewire.customer-reports.customer-reports', [
            'startDate' => $startDateDisplay,
            'endDate' => $endDateDisplay,
            'paidCredits' => $this->paidCredits,
            'unpaidCredits' => $this->unpaidCredits,
            'upcomingPayments' => $this->upcomingPayments,
        ]);
    }

    public function exportToPDF()
    {
        // La validación para la exportación debe ser en el formato d/m/Y porque es el formato que se mostrará en el PDF
        $this->validate([
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'required|date_format:Y-m-d',
        ]);

        $data = [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'paidCredits' => $this->paidCredits,
            'unpaidCredits' => $this->unpaidCredits,
            'upcomingPayments' => $this->upcomingPayments,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('livewire.customer-reports.pdf-customers', $data);

        $startDateForFilename = Carbon::createFromFormat('Y-m-d', $this->startDate)->format('Y-m-d');
        $endDateForFilename = Carbon::createFromFormat('Y-m-d', $this->endDate)->format('Y-m-d');

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "customer-report-{$startDateForFilename}-to-{$endDateForFilename}.pdf"
        );
    }
}