<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< Updated upstream
  {{-- <link rel="stylesheet" href="{{asset('resources/view/pdf.css')}}"> --}}
=======
  <link rel="stylesheet" href="{{public_path('css/pdf.css')}}" type="text/css">
>>>>>>> Stashed changes
  <title>estimacion</title>
</head>
<body>
  
<<<<<<< Updated upstream
  <style>
    @page { size: 21.59cm 27.94cm; }
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    h1,h2,h3,h4,h5,h6 {
      font-weight: 300;
    }

    table {
      max-width: 500px;
      width: 100%;
      border-collapse: collapse;
    }

    table thead tr th {
      text-align: left;
      font-weight: 300;
    }

    table thead tr {
      background: #ccc; 
    }

    table thead tr th, table tbody tr td{
      padding: .8em;
    }
  </style>
  <h1>pdf</h1>

  {{-- @for($i=0; $i<count($interests); $i++) 
    <p>{{$interests[$i]}}</p>
  @endfor
 --}}

  <table >
    <thead >
        <tr class="">
            <th scope="col">
              Pago No.
            </th>
            <th scope="col" >
                fecha pago
            </th>
            <th scope="col">
                cuota fija
            </th>
            <th scope="col" >
                interes
            </th>
            <th scope="col" >
                capital
            </th>
            <th scope="col">
              saldo
            </th>
        </tr>
    </thead>
    <tbody >
      @for($i=0;$i<count($balances)  ;$i++)
        <tr >

          <td scope="row" >
            {{$paymentNumber[$i] ?? 1}}
          </td>

            <td scope="row" >
              {{$dates[$i]}}
              
            </td>
            <td scope="row" >
              Q. {{$fees[$i]}}
            </td>
            <td scope="row" >
              Q. {{$paymentInterests[$i]}}
            </td>
            <td scope="row" >
              Q. {{$currentCapital[$i]}}
            </td>
            <td scope="row" >
              Q. {{$balances[$i]}}
            </td>
            

        </tr>
        @endfor


        
    </tbody>
  </table>

=======
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
    <div class="signature__container"></div>
    <div class="signature__container"></div>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <div class="message message--center">firma acreedor</div>
    <div class="message message--center">firma deudor</div>
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
          <td class="table__body-column table__column">{{$dates[$i]}}</td>
          <td class="table__body-column table__column">{{$fees[$i]}}</td>
          <td class="table__body-column table__column">{{$paymentInterests[$i]}}</td>
          <td class="table__body-column table__column">{{$currentCapital[$i]}}</td>
          <td class="table__body-column table__column">{{$balances[$i]}}</td>
        </tr>
      @endfor
      
    </tbody>
  </table>

</div>
>>>>>>> Stashed changes
</body>
</html>