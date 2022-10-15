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
    <h2 class="message"><span class="meta-data">No de Boleta</span> {{$paymentNumber}} </h2>
    <!-- <h2 class="message"><span class="meta-data">Comprobante de Pago</span></h2> -->
  </div>

  <div class="clear"></div>

  <h1 class="title">comprobante de Pago</h1>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Fecha límite de pago</span> 
      {{$paymentDate}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        Fecha de pago
      </span>
        {{$paymentDay}}
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cliente 
    </span> 
        {{$nameCustomer}} {{$lastNameCustomer}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        DPI
      </span>
      {{$dpiCustomer}}
    </h2>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Cuota </span> 
      Q. {{$fee}} 
    </h2>
    <h2 class="message">
      <span class="meta-data">
        método de pago 
      </span>
        @if($methodPayment === "1")
          efectivo
        @else 
          banco
        @endif
    </h2>
  </div>

  <div class="clear"></div>

  <div class="separator"></div>

  <div class="container-data">
    <h2 class="message"><span class="meta-data">Fue atendido por </span> 
      {{Auth::user()->name}} 
    </h2>
  </div>

  <div class="clear"></div>

</body>
</html>