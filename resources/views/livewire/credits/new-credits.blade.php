<div class="w-full">
  <h1 class="text-xl">Nuevo Crédito</h1>
  @if(session()->has("message"))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
    class="w-2/4 mx-auto bg-green-300 dark:bg-teal-700 text-center p-4 rounded-md dark:text-white text-gray-700">
      <h3 class="text-md">{{ session("message")}}</h3>
    </div>
  @endif


  @if(!$estimate)
  <div class="w-full mx-auto mt-3 p-2 bg-white dark:bg-dark-eval-1 shadow-md" >
    
    <div class="flex flex-col my-4">
      <input type="text" id="amount" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        wire:model="amount" placeholder="monto"  required >
      <x-jet-input-error for="amount"/>

      <input type="text" id="share" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        wire:model="fee" placeholder="cuota"  required >
        <x-jet-input-error for="fee"/>
    </div>

  
    <div  class="w-full my-4 flex gap-2">
      Interés
      <select id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model="interestType">
        <option value="1" >fijo</option>
        <option value="2" >porcentual</option>
      </select>

      <div class="flex flex-col gap-2 w-full">
        <input type="text" id="interest" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        wire:model="interest" placeholder="cuota interés"  required >
        <x-jet-input-error for="interest"/>
      </div>
    </div>

    <label for="paymentDate" class="flex gap-2 my-4" > Fecha de primer pago
      <input type="date" id="paymentDate" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        wire:model="paymentDate" required >
        <x-jet-input-error for="paymentDate"/>
    </label>

    <label for="paymentFrequency" class="flex gap-2 my-4">
      Periodicidad de pago
      <select id="paymentFrequency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        wire:model="paymentFrequency">
        <option value="1">mensual</option>
        <option value="2">semanal</option>
        <option value="3">quincenal</option>
      </select>
    </label>

    <div class="flex gap-2 my-4 flex-col">
      <input type="text" id="search" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
        wire:model="search" placeholder="cliente">

      @if($customers)

      <ul>
      @foreach($customers as $customer)

       
        <li 
          wire:click="customerClicked('{{$customer->name}}', '{{$customer->last_name}}', '{{$customer->dpi}}', {{$customer->id}})" 
          class="dark:bg-dark-eval-3 dark:text-white bg-gray-100 text-gray-700 p-2 cursor-pointer">
          {{$customer->dpi}} {{$customer->name}} {{$customer->last_name}}
        <li />
        
      @endforeach
      
    </ul>
    @endif


    @if($customerSelected)

    <div  class="flex p-4 w-3/4 mx-auto bg-gray-100 rounded-lg dark:bg-gray-700" role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Info</span>
      <div class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
        {{$dpiCustomer}}  {{$nameCustomer}} {{$lastNameCustomer}} 
      </div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close"
        wire:click="unSelectedCustomer()">
        <span class="sr-only">Dismiss</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>
    @else
        <div class="w-1/2 mx-auto rounded-xl p-4 bg-purple-50 text-amber-700 dark:text-amber-400 dark:bg-dark-eval-3">
          <p class="text-center">es necesario seleccionar un cliente</p>
        </div>
    @endif


    </div>

    <div class="w-3/4 mx-auto flex flex-col align-center">
      @if($carPhoto)
        <img src="{{$carPhoto->temporaryUrl() ?? ""}}" alt="profile photo" class="w-1/2 mx-auto object-cover">
      @endif


      @if($carPhoto)
        <x-button wire:click="removeImage()" variant="secondary" class="w-1/4 mx-auto dark:bg-dark-eval-3">eliminar imagen...</x-button>
      @endif
    </div>

    @if(!$carPhoto)
    <div class=" my-4 flex justify-center items-center w-2/4 mx-auto ">
      <label for="dropzone-file" class="flex flex-col justify-center items-center w-full  bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
        <div class="flex flex-col justify-center items-center pt-5 pb-6">
          <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir un archivo de imagen </span></p>
          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" class="hidden" wire:model="carPhoto" required>
        <span class="dark:text-rose-300 text-rose-500">Imagen de automóvil(requerido)</span>
      </label>
      
    </div> 
    <x-jet-input-error for="dropzone-file" />

    @endif

    @if(session()->has("error-credit"))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
    class="w-2/4 mx-auto bg-red-300 dark:bg-red-700 text-center p-4 rounded-md dark:text-white text-gray-700">
      <h3 class="text-md">{{ session("error-credit")}}</h3>
    </div>
    @endif

    <div class=" my-4 flex items-center p-6 space-x-2 rounded-b w-full mx-auto flex-center justify-center">

      <x-button variant="primary" wire:click="feeCalculate()">calcular cuotas</x-button>
      {{-- <button class="bg-gray-900 p-2.5 rounded-md text-white"
        wire:click="cleanFields()">limpiar campos</button> --}}
    </div>

  </div>

  @endif


  @if($estimate)
  <div class="w-full my-4">
    <h2 class="text-lg text-center">Proyección</h2>
    <p>
      capital inicial <span class="font-bold">Q. {{$amount}}</span>
      numero de pagos <span class="font-bold">{{count($paymentNumber)}}</span>
    </p>
    <div class="overflow-x-auto relative">
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
          <tr class="">
              <th scope="col" class="py-3 px-6">
                Pago No.
              </th>
              <th scope="col" class="py-3 px-6">
                  fecha pago
              </th>
              <th scope="col" class="py-3 px-6">
                  cuota fija
              </th>
              <th scope="col" class="py-3 px-6">
                  interes
              </th>
              <th scope="col" class="py-3 px-6">
                  capital
              </th>
              <th scope="col" class="py-3 px-6">
                saldo
              </th>
          </tr>
      </thead>
      <tbody >
        @for($i=0;$i<count($balances)  ;$i++)
          <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">

            <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
              {{$paymentNumber[$i] ?? 1}}
            </td>

              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                {{\Carbon\Carbon::parse($dates[$i])->format('d-m-Y')}}
                
              </td>
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{$fees[$i]}}
              </td>
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{$paymentInterests[$i] ?? $interest}}
              </td>
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{$currentCapital[$i]}}
              </td>
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{$balances[$i]}}
              </td>
              

          </tr>
          @endfor
  
  
          
      </tbody>
    </table>
  </div>
  
    <div class="my-4 flex items-center p-6 space-x-2 rounded-b w-full mx-auto flex-center justify-center">
      <button class="bg-rose-500 hover:bg-rose-600 p-2.5 rounded-md text-white my-4 "
        wire:click="cleanFields()">cancelar</button>

      <form action="{{route('pdfEstimate')}}" method="POST" target="_blank">
        @csrf
        
        <input type="hidden" name="nameCustomer" value="{{json_encode($nameCustomer)}}">
        <input type="hidden" name="lastNameCustomer" value="{{json_encode($lastNameCustomer)}}">
        <input type="hidden" name="dpiCustomer" value="{{json_encode($dpiCustomer)}}">
        <input type="hidden" name="interestType" value="{{json_encode($interestType)}}">
        <input type="hidden" name="interest" value="{{json_encode($interest)}}">
        <input type="hidden" name="amount" value="{{json_encode($amount)}}">
        <input type="hidden" name="balances" value="{{json_encode($balances)}}">
        <input type="hidden" name="fees" value="{{json_encode($fees)}}">
        <input type="hidden" name="paymentInterests" value="{{ json_encode($paymentInterests)}}">
        <input type="hidden" name="currentCapital" value="{{ json_encode($currentCapital)}}">
        <input type="hidden" name="dates" value="{{ json_encode($dates)}}">
        <input type="hidden" name="paymentNumber" value="{{ json_encode($paymentNumber)}}">
        <x-button variant="success" wire:click="save()" type="submit"
          wire:submit.prevent="submit"> 
          generar préstamo
        </x-button>
      </form>

      <form action='{{ route("pdfEstimate") }}' method="POST" target="_blank">
        @csrf

        <input type="hidden" name="nameCustomer" value="{{json_encode($nameCustomer)}}"/>
        <input type="hidden" name="lastNameCustomer" value="{{json_encode($lastNameCustomer)}}"/>
        <input type="hidden" name="dpiCustomer" value="{{json_encode($dpiCustomer)}}"/>
        <input type="hidden" name="interestType" value="{{json_encode($interestType)}}"/>
        <input type="hidden" name="interest" value="{{json_encode($interest)}}"/>
        <input type="hidden" name="amount" value="{{json_encode($amount)}}"/>
        <input type="hidden" name="balances" value="{{json_encode($balances)}}"/>
        <input type="hidden" name="fees" value="{{ json_encode($fees)}}">
        <input type="hidden" name="paymentInterests" value="{{ json_encode($paymentInterests)}}">
        <input type="hidden" name="currentCapital" value="{{ json_encode($currentCapital)}}">
        <input type="hidden" name="dates" value="{{ json_encode($dates)}}">
        <input type="hidden" name="paymentNumber" value="{{ json_encode($paymentNumber)}}">
        <x-button variant="warning" type="submit" 
          wire:submit.prevent="submit">
          pdf
        </x-button>
      </form>  
    </div>
  </div>
  
  @endif 
</div>
