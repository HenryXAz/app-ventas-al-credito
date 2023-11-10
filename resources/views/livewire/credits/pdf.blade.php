<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">  <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">

  <title>estimacion</title>
</head>
<body>
  <img src="{{public_path('images/logo-business.png')}}" alt="bussiness logo" width="50">
  <div class="container" style="page-break-after: auto">
  <h1 class="title">Proyección</h1>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cliente:</span> {{$customer[0]->name}} {{$customer[0]->last_name}}</h2>
    <h2 class="message"><span class="meta-data">DPI: </span> {{$customer[0]->dpi}} </h2>
  </div>

   <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Crédito: </span>Q.{{number_format($amount, 2, '.', ',')}}</h2>
    <h2 class="message"><span class="meta-data">Tipo de Interés: </span>
    @if($interest_type === "1")
      Fijo
    @else 
      Porcentual
    @endif
    
    </h2>
  </div>

  <div class="clear"></div>

  

  <div class="container-data">
    <h2 class="message"><span class="meta-data">No. de Cuotas: </span>{{count($payments)}}</h2>
    <h2 class="message"><span class="meta-data">Tasa de Interés: </span>
    @if($interest_type === "1")
      Q. {{number_format($interest, 2, '.', ',')}}
    @else 
      {{$interest}}%
    @endif
    
    </h2>
  </div>

  <div class="clear"></div>

  
  <div class="container-data">
    <h2 class="message"><span class="meta-data">Total Interés a pagar: </span>Q.{{number_format($total_interest, 2, '.', ',')}}</h2>
  </div>


  <div class="clear"></div>

  <table class="table page-break">
    <thead class="table__head">
      <tr class="table__head-row table__row">
        <th class="table__head-column table__column">Pago No.</th>
        <th class="table__head-column table__column">fecha de pago</th>
        <th class="table__head-column table__column">Cuota</th>
        <th class="table__head-column table__column">Interés</th>
        <th class="table__head-column table__column">Capital</th>
        <th class="table__head-column table__column">Saldo</th>
      </tr>
    </thead>
    <tbody class="table__body table__row">
      @foreach($payments as $payment)
      <tr class="table__body-row table__row">
        <td class="table__body-column table__column">{{$payment->payment_id}}</td>
        <td class="table__body-column table__column">{{\Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y')}}</td>
        <td class="table__body-column table__column">Q.{{number_format($payment->fee, 2, '.', ',')}}</td>
        <td class="table__body-column table__column">Q.{{number_format($payment->interest, 2, '.', ',')}}</td>
        <td class="table__body-column table__column">Q.{{number_format($payment->capital, 2, '.', ',')}}</td>
        <td class="table__body-column table__column">Q.{{number_format($payment->balance, 2, '.', ',')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="container-data">
    <div class="signature__container"></div>
    <div class="signature__container"></div>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <div class="message message--center">firma acreedor</div>
    <div class="message message--center">firma deudor</div>
  </div>

  <div class="clear"></div>

</div>

</body>
</html>