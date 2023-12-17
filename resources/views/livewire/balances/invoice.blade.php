<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{public_path('css/invoice.css')}}" type="text/css">
  <title>factura pago</title>
</head>
<body>
  
  <div class="container-data">
    <h2 class="message"><img src="{{public_path('images/logo-business.jpeg')}}" alt="logo bussiness" width="50"></h2>
    <h2 class="message"><span class="meta-data">No de Boleta</span> {{$payment->payment_number}} </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Fecha límite de pago</span> 
      {{\Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y')}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        Fecha de pago
      </span>
        {{\Carbon\Carbon::parse($payment->payment_day)->format('d-m-Y')}}
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cliente 
    </span> 
        {{$customer->name}} {{$customer->last_name}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        DPI
      </span>
      {{$customer->dpi}}
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cuota </span> 
      Q. {{number_format($payment->fee, 2, '.', ',')}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        método de pago 
      </span>
        @if($payment->method_payment === "1")
          efectivo
        @else 
          banco
        @endif
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">mora </span> 
      Q. {{number_format($payment->financial_default, 2, '.', ',')}} 
    </h2>
    <h2 class="message"><span class="meta-data">saldo </span> 
      Q. {{number_format($payment->balance, 2, '.', ',')}} 
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Interés </span> 
      Q. {{number_format($payment->interest, 2, '.', ',')}} 
    </h2>
  </div>

  <div class="clear"></div>

  <div class="separator"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Fue atendido por </span> 
      {{$payment->received_by}}
    </h2>
  </div>

  <div class="clear"></div>

</body>
</html>