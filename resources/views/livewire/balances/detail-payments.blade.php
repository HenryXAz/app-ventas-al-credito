<div class="w-full dark:bg-dark-eval-2 dark:text-white bg-white p-4 text-gray-600 rounded-md shadow-md">
  <h2 class="text-2xl text-center font-light">
    Detalles del pago
  </h2>

  <div class="w-full my-4 ">
    <div class="w-full my-4 flex justify-between  ">
      <p><span class="dark:text-gray-400 text-gray-900">Pago No.</span> {{$payment->payment_number}}</p>

    </div>

    <div class="w-full my-4 flex justify-between">
      <p><span class="dark:text-gray-400 text-gray-900">Fecha de Pago</span> {{$payment->payment_date}}</p>
      <p><span class="dark:text-gray-400 text-gray-900">Fecha de cancelación</span> {{$payment->payment_day}} </p>
    </div>

    <div class="w-full  my-4 flex justify-between  ">
      <p><span class="dark:text-gray-400 text-gray-900">Cliente </span> {{$nameCustomer}} {{$lastNameCustomer}} </p>
      <p><span class="dark:text-gray-400 text-gray-900">Cuota </span>Q.{{$payment->fee}}</p>
    </div>
  </div>

  <div class="w-full  my-4 flex justify-between  ">
    <p><span class="dark:text-gray-400 text-gray-900">Mora </span>Q. {{$payment->financial_default}}</p>
    <p><span class="dark:text-gray-400 text-gray-900">Recibido por </span>{{$payment->received_by}}</p>
  </div>

  <div class="w-full my-4 flex justify-center gap-2">
    <p><span class="dark:text-gray-400 text-gray-900">Tipo de Pago </span>
    @if($payment->method_payment === "1")
      Efectivo 
    @else 
      Banco
    @endif
    </p>
  </div>

  @if($payment->method_payment === "2")
    <div class="w-full my-4 flex justify-center gap-2">
      <p><span class="dark:text-gray-400 text-gray-900">Comprobante de Pago </span>
        <img src="{{asset('storage/' . $payment->certification_payment)}}" width="600" alt="comprobante banco">
      </p>
    </div>

  @endif

  

  @if($payment->financial_default_method === "2" && $payment->financial_default > 0)

  <div class="w-full my-4 flex justify-center gap-2">
    <p><span class="dark:text-gray-400 text-gray-900">Tipo de Pago Mora </span>
    @if($payment->method_payment === "1")
      Efectivo 
    @else 
      Banco
    @endif
    </p>
  </div>

    <div class="w-full my-4 flex justify-center gap-2">
      <p><span class="dark:text-gray-400 text-gray-900">Comprobante de Mora </span>
        <img src="{{asset('storage/' . $payment->certification_financial_default)}}" width="600" alt="comprobante banco">
      </p>
    </div>
  @endif


  
  <div class="w-full flex gap-2 justify-center my-4">
    <x-button variant="primary" wire:click="cancelPayment">ver todos los pagos</x-button>
  </div>
</div>