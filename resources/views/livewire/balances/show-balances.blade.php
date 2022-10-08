<div class="w-full">
  <form class="w-3/4  gap-2">
    <input type="text" id="search" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
            wire:model="search" placeholder="cliente">
  </form>

  <br>

  @if($customers)

  <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white ">
        <tr class="">

            <th scope="col" class="py-3 px-6">
                nombre
            </th>
            <th scope="col" class="py-3 px-6">
                apellido
            </th>
            <th scope="col" class="py-3 px-6">
                foto de perfil
            </th>
            <th scope="col" class="py-3 px-6">
                email
            </th>
            <th scope="col" class="py-3 px-6">

            </th>
        </tr>
    </thead>
    <tbody >
        @foreach($customers as $customer)
            <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
            <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                {{$customer->name}}
            </td>
            <td class="py-4 px-6 text-gray-900 dark:text-white ">
                {{$customer->last_name}}
            </td>
            <td class="py-4 px-6 text-gray-900 dark:text-white ">
            <img src="{{ asset("storage/" .$customer->photo )}}" alt="perfil image"
            width="100" >
            </td>
            <td class="py-4 px-6 text-gray-900  dark:text-white">
                {{$customer->email}}
            </td>
            <td class="py-4 px-6 text-gray-900  dark:text-white">
                <x-button variant="info" wire:click="customerClicked('{{$customer->name}}', '{{$customer->last_name}}', '{{$customer->dpi}}', {{$customer->id}})">
                  Ver Créditos
                </x-button>
            </td>

            </tr>
        @endforeach

    </tbody>
  </table>

  @endif

  @if($customerSelected)
    <div  class="flex p-4 w-3/4 mx-auto bg-gray-100 rounded-lg dark:bg-gray-700" role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>

      @if($creditSelected)
        <a class="text-red-400" wire:click="customerClicked('{{$nameCustomer}}', '{{$lastNameCustomer}}', '{{$dpiCustomer}}', {{$idCustomer}})">
            Ver Créditos
        </a>
      @endif

      <div class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
        {{$dpiCustomer}}  {{$nameCustomer}} {{$lastNameCustomer}}
      </div>

      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close"
        wire:click="unSelectedCustomer()">
        <span class="sr-only">Dismiss</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div>


        @foreach($credits as $credit)
            <button class="w-full" wire:click="creditClicked({{$credit->id}})">
                <div class="flex flex-col p-4 my-4 w-3/4 mx-auto bg-gray-100 rounded-lg dark:bg-dark-eval-3" role="alert">
                    <div class="p-2 text-sm w-full font-medium text-gray-700 dark:text-gray-300 flex justify-between  mx-auto gap-4">
                        <h2 class="text-xl">monto de crédito <span class="text-emerald-500">Q. {{$credit->capital}}</span></h2>
                        <p>tipo de interés <span class="text-purple-400">{{$credit->interest_type}}</span></p>
                    </div>

                    <div class="flex p-2 my-2 w-full mx-auto bg-gray-100 rounded-lg dark:bg-dark-eval-3">
                        <p>frecuencia de pago <span class="text-blue-400">{{$credit->payment_frequency}}</span></p>
                    </div>
                </div>
            </button>
        @endforeach

  @endif

  @if($creditSelected)

  <div  class="flex p-4 w-3/4 mx-auto bg-gray-100 rounded-lg dark:bg-gray-700" role="alert">

      <div class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
        Pendiente por pagar: Q. {{$pendientePagar}}
      </div>

  </div>


  <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
      <tr>
        <th class="py-3 px-6">Fecha</th>
        <th class="py-3 px-6">Capital</th>
        <th class="py-3 px-6">Saldo</th>
      </tr>
    </thead>
    <tbody>
        @foreach($payments as $pay)

        <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1">
            <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            {{ $pay->payment_date }}
            </td>
            <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                @if($pay->status == '1')
                    <span class="text-red-400">{{ $pay->capital }}</span>
                @else
                    <span class="text-blue-400">{{ $pay->capital }}</span>
                @endif
            </td>
            <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                {{ $pay->balance }}
            </td>
        </tr>

        @endforeach
    </tbody>
  </table>
  @endif
</div>
