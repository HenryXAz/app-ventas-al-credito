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
            color: #1b76d1;
        }
        .table th,
        .table td {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
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
    </style>

<div class="date-selector" x-data="{ startDate: @entangle('startDate'), endDate: @entangle('endDate') }">
    <input type="text" x-ref="start" x-model="startDate" placeholder="dd/mm/YYYY">
    <input type="text" x-ref="end" x-model="endDate" placeholder="dd/mm/YYYY">
    <button wire:click="updateDateRange">Actualizar</button>
    <button wire:click="exportToPDF" wire:loading.attr="disabled">Exportar a PDF</button>
</div>
    <div class="loading" wire:loading>
        Cargando los datos...
    </div>

    <h2>Créditos Pagados</h2>
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

    <h2>Créditos No Pagados</h2>
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

    <h2>Próximos Pagos</h2>
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