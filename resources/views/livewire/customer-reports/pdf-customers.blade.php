<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{public_path("css/pdf.css")}}">
  <title>reporte clientes</title>
</head>
<body>

  @if($report === "1")
    <h1 class="title">Clientes que pagan esta semana</h1>

    <p class="center">(Correspondiente a la semana {{date("d-m-Y", strtotime($startWeek))}} al {{date("d-m-Y", strtotime($endWeek))}}) </p>
  @elseif($report === "2")
    <h1 class="title">Clientes que no pagan esta semana</h1>
    <p class="center">(Correspondiente a la semana {{date("d-m-Y", strtotime($startWeek))}} al {{date("d-m-Y", strtotime($endWeek))}}) </p>
  @elseif($report === "3")
    <h1 class="title">Clientes con pagos atrasados</h1>
    <p class="center">Registro de pagos atrasados emitido el {{date("d-m-Y")}}</p>
  @endif

  
  <table class="table page-break">
    <thead class="table_thead">
      <tr class="table__head-row table__row">
        <th class="table__head-column table__column">nombre</th>
        <th class="table__head-column table__column">email</th>
        <th class="table__head-column table__column">teléfono</th>
        <th class="table__head-column table__column">monto</th>
        <th class="table__head-column table__column">fecha pago</th>
        <th class="table__head-column table__column">No. crédito</th>
      </tr>
    </thead>
    <tbody>
      @foreach($credits as $credit)
      <tr class="table__body-row table__row">
        <td class="table__body-column table__column">
          {{$credit->customer->name}}
          {{$credit->customer->last_name}}
        </td>
        <td class="table__body-column table__column">
          {{$credit->customer->email}}
        </td>
        <td class="table__body-column table__column">
          {{$credit->customer->personal_phone}}
        </td>
        <td class="table__body-column table__column">
          Q.{{$credit->nextPayment($credit->id)->fee}}
        </td>
        <td class="table__body-column table__column">
          {{$credit->nextPayment($credit->id)->payment_date}}
        </td>
        <td>
          {{$credit->id}}
        </td class="table__body-column table__column">
      </tr>
      @endforeach
    </tbody>
  </table>


</body>
</html>