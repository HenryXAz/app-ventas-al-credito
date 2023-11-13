
<div>
    <style>
        .date-selector input[type='date'] {
            border: 1px solid #ced4da;
            padding: .375rem .75rem;
            border-radius: .25rem;
            color: #495057;
            background-color: #fff;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .date-selector input[type='date']:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(13, 90, 167, 0.25);
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            /* color: #1b76d1; */
        }
        .table th,
        .table td {
            padding: .75rem;
            vertical-align: top;
            /* border-top: 1px solid #dee2e6; */
            background-color: #212F3C ;
            text-align: center;
            
        }
        .table thead th {
            vertical-align: bottom;
            /* border-bottom: 2px solid #dee2e6; */
            background-color: #17202A;
            
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .table .table {
            background-color: #fff;
        }
        .loading {
            text-align: center;
            padding: 1rem;
        }

        .title{
        text-align: center;
        font-size: 30px;
        }
        .sub{
            text-align: center; 
            font-size: 20px;
        }
    </style>
    
<h1 class="title">Reporte clientes</h1>
    
<div class="date-selector" x-data="{ startDate: @entangle('startDate'), endDate: @entangle('endDate') }">

    <!-- <input type="text" x-ref="start" x-model="startDate" placeholder="dd/mm/YYYY">
    <input type="text" x-ref="end" x-model="endDate" placeholder="dd/mm/YYYY"> -->
    
    <div class="flex flex-col md:flex-row gap-5">
        <div class="flex flex-col md:flex-row gap-4">
            <label  for="start_date">Fecha Inicial:</label>
            <input class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" type="date"  x-ref="start" x-model="startDate"  name="start_date" id="start_date" wire:model.live="start_date">
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <label for="end_date">Fecha Final:</label>
            <input class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" type="date" x-ref="end" x-model="endDate"  name="end_date" id="end_date" wire:model.live="end_date">
        </div>
    </div>

</div  class="flex flex-col md:flex-row gap-5">

    <div class="flex flex-col md:flex-row gap-5">
        <div class="flex flex-col md:flex-row gap-4">
            <x-button variant="primary" wire:click="updateDateRange">Actualizar</x-button>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <x-button variant="warning" wire:click="exportToPDF" wire:loading.attr="disabled">Exportar a PDF</x-button>
        </div>
    </div>


    <div class="loading" wire:loading>
        Cargando los datos...
    </div>

<div class="flex flex-col md:flex-row gap-5">



</div>
<h2 class="sub">Créditos Pagados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($paidCredits as $credit)
            <tr>
                <td>{{ $credit->customer->name ?? 'N/A' }}</td>
                <td>{{ number_format($credit->fee ?? 0, 2, ',', '.') }}</td>
                <td>
                    @php
                        $payment = $credit->payments->where('status', '2')->first();
                    @endphp
                    {{ $payment ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : 'N/A' }}
                </td>
            </tr>
        @empty
                <tr><td colspan="3">No hay créditos pagados en este rango de fechas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2 class="sub">Créditos No Pagados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Fecha de Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unpaidCredits as $credit)
                <tr>
                    <td>{{ $credit->customer->name ?? 'N/A' }}</td>
                    <td>{{ number_format($credit->fee ?? 0, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($credit->due_date)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No hay créditos no pagados en este rango de fechas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2 class="sub">Próximos Pagos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Monto Próximo Pago</th>
                <th>Fecha Próximo Pago</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($upcomingPayments as $payment)
            <tr>
                <td>{{ $payment->customer->name ?? 'N/A' }}</td>
                <td>{{ number_format($payment->fee ?? 0, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="3">No hay pagos próximos en este rango de fechas.</td></tr>
        @endforelse
        </tbody>
    </table>
    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('datePicker', () => ({
                init() {
                    this.$nextTick(() => {
                        flatpickr(this.$refs.start, {
                            dateFormat: 'd/m/Y',
                            onChange: (selectedDates, dateStr, instance) => {
                                this.startDate = dateStr;
                            },
                        });
                        flatpickr(this.$refs.end, {
                            dateFormat: 'd/m/Y',
                            onChange: (selectedDates, dateStr, instance) => {
                                this.endDate = dateStr;
                            },
                        });
                    });
                },
            }));

            Alpine.start();
        });
    </script>
    @endpush
</div>