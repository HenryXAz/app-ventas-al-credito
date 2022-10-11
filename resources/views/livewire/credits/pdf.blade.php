<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link rel="stylesheet" href="{{asset('resources/view/pdf.css')}}"> --}}
  <title>estimacion</title>
</head>
<body>
  
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

</body>
</html>