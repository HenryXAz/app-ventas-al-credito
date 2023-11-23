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
            /* background-color: #212F3C ; */
            text-align: center;
            
        }
        .table thead th {
            vertical-align: bottom;
            /* border-bottom: 2px solid #dee2e6; */
            background-color: #D0D3D4  ; 
            
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
        font-size: 34px;
        }
        .sub{
            text-align: center; 
            font-size: 20px;
        }
    </style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{public_path('css/pdf.css')}}">
  <title>reporte clientes</title>
</head>
<body>
<<<<<<< Updated upstream
  <img src="{{public_path('images/logo-business.png')}}" alt="logo bussiness" width="50">
  <h1 class="title">Listado reporte clientes</h1>
    
  <h2 class="w-full text-sm md:text-2xl my-3 font-light">
        Reporte del {{\Carbon\Carbon::parse($startDate)->format('d-m-Y')}} hasta {{\Carbon\Carbon::parse($endDate)->format('d-m-Y')}} </h2>
=======
  <img src="{{public_path('images/logo-business.jpeg')}}" alt="logo bussiness" width="50">
  @if($report === "1")
    <h1 class="title">Clientes que pagan esta semana</h1>

    <p class="center">(Correspondiente a la semana {{\Carbon\Carbon::parse($startWeek)->format('d-m-Y')}} al {{\Carbon\Carbon::parse($endWeek)->format('d-m-Y')}}) </p>
  @elseif($report === "2")
    <h1 class="title">Clientes que no pagan esta semana</h1>
    <p class="center">(Correspondiente a la semana {{\Carbon\Carbon::parse($startWeek)->format('d-m-Y')}} al {{\Carbon\Carbon::parse($endWeek)->format('d-m-Y')}}) </p>
  @elseif($report === "3")
    <h1 class="title">Clientes con pagos atrasados</h1>
    <p class="center">Registro de pagos atrasados emitido el {{\Carbon\Carbon::today('America/Guatemala')->format('d-m-Y')}}</p>
  @endif
>>>>>>> Stashed changes

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
                    {{ $payment ? \Carbon\Carbon::parse($payment->payment_day)->format('d/m/Y') : 'N/A' }}
                </td>
            </tr>
            
        @empty
               
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
            @if($startDate<= (\Carbon\Carbon::parse($credit->due_date)->format('Y-m-d')) && $endDate>= (\Carbon\Carbon::parse($credit->due_date)->format('Y-m-d')))
                <tr>
                    <td>{{ $credit->customer->name ?? 'N/A' }}</td>
                    <td>{{ number_format($credit->fee ?? 0, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($credit->due_date)->format('d/m/Y') }}</td>
                </tr>
            @endif
            @empty
               
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
            @forelse ($unpaidCredits as $credit)
            @if($startDate<= (\Carbon\Carbon::parse($credit->next_payment_date)->format('Y-m-d')) && $endDate>= (\Carbon\Carbon::parse($credit->next_payment_date)->format('Y-m-d')))
                <td>{{ $credit->name_customer ?? 'N/A'  }}</td>
                <td>{{ number_format($credit->fee ?? 0, 2, ',', '.')  }}</td>
                <td>{{  \Carbon\Carbon::parse($credit->next_payment_date)->format('d/m/Y')}}</td>
            </tr>
        @endif
        @empty
          
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


</body>
</html>