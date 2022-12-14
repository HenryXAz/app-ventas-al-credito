<div class="w-full dark:bg-dark-eval-2 dark:text-white bg-white p-4 text-gray-600 rounded-md shadow-md">

  @if(session()->has("message"))
  <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="w-2/4 mx-auto bg-green-300 dark:bg-teal-700 text-center p-4 rounded-md dark:text-white text-gray-700">
    <h3 class="text-md">{{ session("message")}}</h3>
  </div>
  @endif

  <div class="w-full my-4 ">
    <div class="w-full my-4 flex justify-between  ">
      <p><span class="dark:text-gray-400 text-gray-900">Pago No.</span> {{$payment->payment_number}}</p>

    </div>

    <div class="w-full my-4 flex justify-between">
      <p><span class="dark:text-gray-400 text-gray-900">Fecha de Pago</span> {{\Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y')}}</p>
      <p><span class="dark:text-gray-400 text-gray-900">Fecha de cancelación</span> {{  \Carbon\Carbon::today("America/Guatemala")->format("d-m-Y")}} </p>
    </div>

    <div class="w-full  my-4 flex justify-between  ">
      <p><span class="dark:text-gray-400 text-gray-900">Cliente </span> {{$nameCustomer}} {{$lastNameCustomer}} </p>
      <p><span class="dark:text-gray-400 text-gray-900">Cuota </span>Q.{{$payment->fee}}</p>
    </div>
  </div>

  <div class="w-full  my-4 flex justify-between  ">
    <p><span class="dark:text-gray-400 text-gray-900">Recibido por </span>{{Auth::user()->name}}</p>
  </div>

  <div class="w-full my-4 flex justify-center gap-2">
    Tipo de pago
    <select name="" id="methodPayment" class="bg-white dark:bg-dark-eval-3" wire:model="methodPayment">
      <option value="1">efectivo</option>
      <option value="2">banco</option>
    </select>
  </div>

  @if($certificationPayment)
  <img src="{{$certificationPayment->temporaryUrl()}}" alt="comprobante de pago" width="200" class="w-1/2 mx-auto object-cover">
  @endif

  @if($certificationPayment)
      {{-- <x-button wire:click="removeImage('1')" variant="secondary" class="w-1/4 mx-auto dark:bg-dark-eval-1">eliminar imagen...</x-button> --}}
    <div class="w-full flex justify-center">
      <button wire:click="removeImage('1')" class="w-1/4 p-2.5 text-center  dark:bg-dark-eval-1 bg-gray-100 text-gray-800 dark:text-white rounded-md " >eliminar imagen...</button>
    </div>
  @endif

  @if($methodPayment === "2" && !$certificationPayment)
  <div class=" my-4 flex justify-center items-center w-2/4 mx-auto ">
    <label for="dropzone-file" class="flex flex-col justify-center items-center w-full  bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
      <div class="flex flex-col justify-center items-center pt-5 pb-6">
        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
        </svg>
        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir un archivo de imagen </span></p>
        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
      </div>
      <input id="dropzone-file" type="file" class="hidden" wire:model="certificationPayment" required>
      <span class="dark:text-rose-300 text-rose-500">comprobante requerido</span>
    </label>

  </div>
  {{-- <x-jet-input-error for="dropzone-file" /> --}}
  @endif


  @if($payment->payment_date < \Carbon\Carbon::today("America/Guatemala"))
  <h2 class="my-4 w-full text-center font-light text-xl">Pago atrasado, se debe de cobrar mora</h2>

  <label for="financialDefault" class="w-full flex items-center gap-2">
    Cantidad de mora Q.
    <input type="text" class="w-3/4 mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
    id="financialDefault"  wire:model="financialDefault" >
  </label>

  <div class="w-1/2 my-6 flex justify-start gap-2">
    Tipo de pago
    <select name="" id="methodFinancialDefault" class=" bg-white dark:bg-dark-eval-3" 
      wire:model="financialDefaultMethod">
      <option value="1">efectivo</option>
      <option value="2">banco</option>
    </select>
  </div>

    @if($certificationFinancialDefault)
      <img src="{{$certificationFinancialDefault->temporaryUrl()}}" alt="comprobante de mora" width="200" class="w-1/2 mx-auto object-cover">
    @endif

    @if($certificationFinancialDefault)
      {{-- <x-button wire:click="removeImage('2')" variant="secondary" class="w-1/4 mx-auto dark:bg-dark-eval-1">eliminar imagen...</x-button> --}}
      <div class="w-full flex justify-center">
        <button wire:click="removeImage('2')" class="w-1/4 p-2.5 text-center  dark:bg-dark-eval-1 bg-gray-100 text-gray-800 dark:text-white rounded-md " >eliminar imagen...</button>
      </div>
    @endif

    @if($financialDefaultMethod === "2" && !$certificationFinancialDefault)
    <div class=" my-4 flex justify-center items-center w-2/4 mx-auto ">
      <label for="dropzone-file" class="flex flex-col justify-center items-center w-full  bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <div class="flex flex-col justify-center items-center pt-5 pb-6">
          <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
          </svg>
          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir un archivo de imagen </span></p>
          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" class="hidden" wire:model="certificationFinancialDefault" required>
        <span class="dark:text-rose-300 text-rose-500">comprobante requerido</span>
      </label>
  
    </div>
    @endif
  @endif



  <div class="w-full flex gap-2 justify-end my-6">
    <x-button variant="info" wire:click="cancelPayment">regresar a la tabla de pagos</x-button>
    
    @if(!session()->has("message"))
    <x-button variant="success" wire:click="toPay()">realizar pago</x-button>
    @endif

    @if(session()->has("message"))
    <form action='{{ route("pdfInvoice") }}' method="POST" target="_blank">
      @csrf

      <input type="hidden" name="nameCustomer" value="{{json_encode($nameCustomer)}}" />
      <input type="hidden" name="lastNameCustomer" value="{{json_encode($lastNameCustomer)}}" />
      <input type="hidden" name="dpiCustomer" value="{{json_encode($dpiCustomer)}}" />
      <input type="hidden" name="paymentNumber" value="{{json_encode($payment->payment_number)}}" />
      <input type="hidden" name="paymentDate" value="{{json_encode($payment->payment_date)}}" />
      <input type="hidden" name="fee" value="{{json_encode($payment->fee)}}" />
      <input type="hidden" name="method_payment" value="{{json_encode($payment->method_payment)}}" />
      <input type="hidden" name="paymentDay" value="{{json_encode($payment->payment_day)}}" />
      <input type="hidden" name="financialDefault" value="{{json_encode($payment->financial_default)}}">
      <input type="hidden" name="balance" value="{{json_encode($payment->balance)}}">
      <input type="hidden" name="receivedBy" value="{{json_encode(Auth::user()->name)}}">
      <x-button variant="danger" type="submit" wire:submit.prevent="submit">
        recibo
      </x-button>
    </form>
    @endif

  </div>
</div>