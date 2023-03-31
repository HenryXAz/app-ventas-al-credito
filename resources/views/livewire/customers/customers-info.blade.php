<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{public_path('css/invoice.css')}}" type="text/css">
  <title>info cliente</title>
</head>
<body>
  <style>
    @page {
      size: 21.59cm 27.94cm;
    }
  </style>

  <div class="container-data">
    <h2 class="message"><img src="{{public_path('images/logo-business.png')}}" alt="logo bussiness" width="50"></h2>
    <h1 class="messge">Información Cliente</h1>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message">Estos son los datos que el cliente ha proporcionado:</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Nombre:</span> {{$name}}</p>
    <p class="message-customer-info"><span class="meta-data">Apellido:</span> {{$last_name}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">DPI:</span> {{$dpi}}</p>
    <p class="message-customer-info"><span class="meta-data">NIT:</span> {{$nit}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Número personal:</span> {{$personalPhone}}</p>
    <p class="message-customer-info"><span class="meta-data">Número domicilio:</span> {{$homePhone}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Número trabajo:</span> {{$employmentPhone}}</p>
    <p class="message-customer-info"><span class="meta-data">Empresa:</span> {{$companyName}}</p>
  </div>

  <div class="clear"></div>
  
  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Dirección trabajo:</span> {{$employmentAddress}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Dirección domicilio:</span> {{$homeAddress}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Facebook:</span> {{$facebook}}</p>
    <p class="message-customer-info"><span class="meta-data">Email:</span> {{$email}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Nombre referencia:</span> {{$nameReference}}</p>
    <p class="message-customer-info"><span class="meta-data">Apellido referencia:</span> {{$lastNameReference}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Teléfono referencia:</span> {{$phoneReference}}</p>
    <p class="message-customer-info"><span class="meta-data">Email referencia:</span> {{$emailReference}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Nombre 2da referencia:</span> {{$nameSecondReference}}</p>
    <p class="message-customer-info"><span class="meta-data">Apellido 2da referencia:</span> {{$lastNameSecondReference}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Teléfono 2da referencia:</span> {{$phoneSecondReference}}</p>
    <p class="message-customer-info"><span class="meta-data">Email 2da referencia:</span> {{$emailSecondReference}}</p>
  </div>
  
  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Nombre 3da referencia:</span> {{$nameThirdReference}}</p>
    <p class="message-customer-info"><span class="meta-data">Apellido 3da referencia:</span> {{$lastNameThirdReference}}</p>
  </div>

  <div class="clear"></div>

  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">¿es casado? </span> 
      {{($married )? "sí" : "no"}}
    </p>
    <p class="message-customer-info"><span class="meta-data">¿renta? </span> 
      {{($rent)? "sí" : "no"}}
    </p>
  </div>

  <div class="clear"></div>

  {{-- @if($married )
  <div class="container-data">
    <p class="message-customer-info"><span class="meta-data">Nombre conyuge:</span> {{$conyuge->name}}</p>
    <p class="message-customer-info"><span class="meta-data">Apellido conyuge:</span> {{$conyuge->last_name}}</p>
  </div>
  @endif --}}

</body>
</html>