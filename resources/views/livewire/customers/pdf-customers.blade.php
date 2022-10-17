<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{public_path('css/pdf.css')}}">
  <title>listado clientes</title>
</head>
<body>
  <h1 class="title">Listado de clientes registrados</h1>

  <table class="table page-break">
    <thead class="table_thead">
      <tr class="table__head-row table__row">
        <th class="table__head-column table__column">nombre</th>
        <th class="table__head-column table__column">email</th>
        <th class="table__head-column table__column">teléfono</th>
      </tr>
    </thead>
    <tbody>
      @foreach($customers as $customer)
      <tr class="table__body-row table__row">
        <td class="table__body-column table__column">
          {{$customer->name}}
          {{$customer->last_name}}
        </td>
        <td class="table__body-column table__column">
          {{$customer->email}}
        </td>
        <td class="table__body-column table__column">
          {{$customer->personal_phone}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>