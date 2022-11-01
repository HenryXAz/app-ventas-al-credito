<div class="w-full">
  <a href="{{route("activeCredits")}}" target="_blank" class="inline-block bg-indigo-500 hover:bg-indigo-600 p-3 text-white rounded-md mt-6 mb-5">
    informe créditos activos
  </a>

  <form class="w-3/4  gap-2 my-2">
    <input type="text" id="search" class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" wire:model="search" placeholder="cliente">
  </form>

  <br>

  @if($customers)

  <ul>
    @foreach($customers as $customer)


    <li wire:click="customerClicked('{{$customer->name}}', '{{$customer->last_name}}', '{{$customer->dpi}}', {{$customer->id}})" class="dark:bg-dark-eval-3 flex gap-2 justify-around items-center rounded-md dark:text-white bg-white text-gray-700 p-2 cursor-pointer">
      {{$customer->dpi}} {{$customer->name}} {{$customer->last_name}} <img src="{{asset("storage/" . $customer->photo)}}" alt="customer photo" width="100">
      <li />

      @endforeach

      @endif

      @if($customerSelected)
      <div class="flex p-4 w-3/4 mx-auto bg-white rounded-lg dark:bg-gray-700" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>

        @if($creditSelected)
        <a class="text-red-400 cursor-pointer" wire:click="customerClicked('{{$nameCustomer}}', '{{$lastNameCustomer}}', '{{$dpiCustomer}}', {{$idCustomer}})">
          Ver Créditos
        </a>
        @endif

        <div class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
          {{$dpiCustomer}} {{$nameCustomer}} {{$lastNameCustomer}}
        </div>

        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close" wire:click="unSelectedCustomer()">
          <span class="sr-only">Dismiss</span>
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>

      @foreach($credits as $credit)
      <div class="w-full">
        <button class="flex flex-col p-4 my-4 w-3/4 mx-auto bg-white rounded-lg dark:bg-dark-eval-3" role="alert" wire:click="creditClicked({{$credit->id}})">
          <div class="p-2 text-sm w-full font-medium text-gray-700 dark:text-gray-300 flex justify-between  mx-auto gap-4">
            <h2 class="text-xl">monto de crédito <span class="text-emerald-500">Q. {{$credit->capital}}</span></h2>
            <p>tipo de interés <span class="text-purple-400">
                @if($credit->interest_type === "1")
                Fijo
                @elseif($credit->interest_type === "2")
                Porcentual
                @else
                {{$credit->interest_type}}
                @endif
              </span></p>
          </div>

          <div class="flex p-2 gap-2 my-2 justify-between w-full mx-auto bg-white rounded-lg dark:bg-dark-eval-3">
            <p>frecuencia de pago <span class="text-blue-400">
                {{-- {{$credit->payment_frequency}} --}}
                @if($credit->payment_frequency === "1")
                Mensual
                @elseif($credit->payment_frequency === "2")
                Semanal
                @elseif($credit->payment_frequency === "3")
                Quincenal
                @else
                {{$credit->payment_frequency}}
                @endif
              </span></p>
            <img src="{{asset("storage/" . $credit->car_image)}}" alt="foto vehículo" width="100">

          </div>

          <div class="flex p-2 gap-2 my-2 justify-between w-full mx-auto bg-white rounded-lg dark:bg-dark-eval-3">
            <p>saldo pendiente <span class="text-indigo-700 dark:text-indigo-300"> Q. {{ $subBalance[$credit->id]}}</span></p>
          </div>
        </button>
      </div>
      @endforeach

      @endif

      @if($confirmPayment)
      @include("livewire.balances.confirm-payment-dialog")
      @endif

      @if($paymentDetails)
      @include("livewire.balances.detail-payments")
      @endif


      @if($creditSelected)

      <select name="" class="dark:bg-dark-eval-2 border-none bg-white" id="paymentType" wire:model="paymentStatus" wire:click="creditClicked({{$idCredit}})">
        <option value="3">todos</option>
        <option value="1">pendiente</option>
        <option value="2">cancelado</option>
      </select>

      <div class="flex justify-end w-full ">
        <p>No. de Cuotas {{count($feesNumber)}}</p>
      </div>

      <div class="overflow-x-auto relative">
        <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
            <tr>
              <th class="py-3 px-6">No de cuota</th>
              <th class="py-3 px-6">Fecha</th>
              <th class="py-3 px-6">Cuota</th>
              <th class="py-3 px-6">Capital</th>
              <th class="py-3 px-6">Saldo</th>
              <th class="py-3 px-6"></th>
              <th class="py-3 px-6"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($payments as $pay)

            <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1">
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                {{ $pay->payment_number }}
              </td>
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                {{ $pay->payment_date }}
              </td>
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{ $pay->fee }}
              </td>
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                @if($pay->status == '1')
                <span class="text-red-400">Q. {{ $pay->capital }}</span>
                @else
                <span class="text-blue-400">Q. {{ $pay->capital }}</span>
                @endif
              </td>
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                Q. {{ $pay->balance }}
              </td>
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                @if($pay->status === "1")
                <x-button variant="success" wire:click="confirmPayment({{$pay->id}})">pagar</x-button>
                @else
                <form action='{{ route("pdfInvoice") }}' method="POST" target="_blank">
                  @csrf

                  <input type="hidden" name="nameCustomer" value="{{json_encode($nameCustomer)}}" />
                  <input type="hidden" name="lastNameCustomer" value="{{json_encode($lastNameCustomer)}}" />
                  <input type="hidden" name="dpiCustomer" value="{{json_encode($dpiCustomer)}}" />
                  <input type="hidden" name="paymentNumber" value="{{json_encode($pay->payment_number)}}" />
                  <input type="hidden" name="paymentDate" value="{{json_encode($pay->payment_date)}}" />
                  <input type="hidden" name="fee" value="{{json_encode($pay->fee)}}" />
                  <input type="hidden" name="method_payment" value="{{json_encode($pay->method_payment)}}" />
                  <input type="hidden" name="paymentDay" value="{{json_encode($pay->payment_day)}}" />
                  <input type="hidden" name="financialDefault" value="{{json_encode($pay->financial_default)}}">
                  <input type="hidden" name="balance" value="{{json_encode($pay->balance)}}">
                  <input type="hidden" name="receivedBy" value="{{json_encode(Auth::user()->name)}}">
                  <x-button variant="info" type="submit" wire:submit.prevent="submit">
                    recibo
                  </x-button>
                </form>
                <!-- <x-button variant="info" href="{{route('pdfInvoice')}}" target="_blank">recibo</x-button> -->



                
              </td>
              @endif
              <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                @if($pay->status !== "1")
                <x-button class="" wire:click="viewPaymentDetails({{$pay->id}})">
                  ver detalles
                </x-button>
                
                @endif
              </td>

              
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>

      @endif


</div>