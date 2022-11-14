<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">  <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">

  
  <title>estimacion</title>
</head>
<body>
  <img src="{{public_path('images/logoBussiness.jpg')}}" alt="bussiness logo" width="200">
  <div class="container" style="page-break-after: auto">
  <h1 class="title">Proyección</h1>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cliente:</span> {{$nameCustomer}} {{$lastNameCustomer}}</h2>
    <h2 class="message"><span class="meta-data">DPI: </span> {{$dpiCustomer}} </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Crédito: </span>Q.{{$amount}}</h2>
    <h2 class="message"><span class="meta-data">Tipo de Interés: </span>
    @if($interestType === "1")
      Fijo
    @else 
      Porcentual
    @endif
    
    </h2>
  </div>

  <div class="clear"></div>


  <div class="container-data">
    <h2 class="message"><span class="meta-data">No. de Cuotas: </span>{{count($paymentNumber)}}</h2>
    <h2 class="message"><span class="meta-data">Tasa de Interés: </span>
    @if($interestType === "1")
      Q. {{$interest}}
    @else 
      {{$interest}}%
    @endif
    
    </h2>
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
      @for($i=0;$i<count($balances); $i++)
        <tr class="table__body-row table__row">
          <td class="table__body-column table__column">{{$paymentNumber[$i]}}</td>
          <td class="table__body-column table__column">{{\Carbon\Carbon::parse($dates[$i])->format('d-m-Y')}}</td>
          <td class="table__body-column table__column">Q.{{$fees[$i]}}</td>
          <td class="table__body-column table__column">Q.{{$paymentInterests[$i]}}</td>
          <td class="table__body-column table__column">Q.{{$currentCapital[$i]}}</td>
          <td class="table__body-column table__column">Q.{{$balances[$i]}}</td>
        </tr>
      @endfor
      
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