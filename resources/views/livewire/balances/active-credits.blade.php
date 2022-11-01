<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{public_path('css/pdf.css')}}">
  <title>créditos activos</title>
</head>
<body>
  <img src="{{public_path('images/logoBussiness.jpg')}}" alt="logo bussiness" width="200">

  <h1 class="title">créditos activos</h1>
  
  <table class="table page-break">
    <thead class="table_thead">
      <tr class="table__head-row table__row">
        <th class="table__head-column table__column">nombre</th>
        <th class="table__head-column table__column">email</th>
        <th class="table__head-column table__column">teléfono</th>
        <th class="table__head-column table__column">crédito</th>
        <th class="table__head-column table__column">saldo</th>
      </tr>
    </thead>
    <tbody>
      @foreach($credits as $credit)
      <tr class="table__body-row table__row">
        <td class="table__body-column table__column">
          {{$credit->name_customer}}
        </td>
        <td class="table__body-column table__column">
          {{$credit->customer->email}}
        </td>
        <td class="table__body-column table__column">
          {{$credit->customer->personal_phone}}
        </td>
        <td class="table__body-column table__column">
          Q.{{$credit->capital}}
        </td>
        <td class="table__body-column table__column">
          Q. {{$credit->currentBalance($credit->id)}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>