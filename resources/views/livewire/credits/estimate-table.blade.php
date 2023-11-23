<div class="w-full my-4">
  <h2 class="text-lg text-center">Proyección</h2>
  <p>
    capital inicial <span class="font-bold">Q. {{number_format($amount, 2, '.', ',')}}</span>
    numero de pagos <span class="font-bold">{{($payments !== null) ? count($payments) : 0}}</span>
  </p>

  <p>
    intereses totales <span class="font-bold">Q. {{number_format($totalInterest, 2, '.', ',')}}</span>
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
      <tbody>
        @if($payments !== null && count($payments) > 0)
        @foreach($payments as $payment)
        <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            Q. {{$payment->payment_number}}
          </td>
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            {{\Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y')}}
          </td>
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            Q. {{number_format($payment->fee, 2, '.', ',')}}
          </td>
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            Q. {{number_format($payment->interest, 2, '.', ',')}}
          </td>
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            Q. {{number_format($payment->recovered_capital, 2, '.', ',')}}
          </td>
          <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
            Q. {{number_format($payment->balance, 2, '.', ',')}}
          </td>
        </tr>
        @endforeach
        @endif

      </tbody>
    </table>
  </div>

  <div class="my-4 flex items-center p-6 space-x-2 rounded-b w-full mx-auto flex-center justify-center">
    <button class="bg-rose-500 hover:bg-rose-600 p-2.5 rounded-md text-white my-4 "
      wire:click="cleanFields()">Cancelar</button>

    <form action="{{route('pdfEstimate')}}" method="POST" target="_blank">
      @csrf
      <input type="hidden" name="customer" value="{{json_encode($customerSelected)}}">
      <input type="hidden" name="amount" value="{{json_encode($amount)}}">
      <input type="hidden" name="interest" value={{json_encode($interest)}}>
      <input type="hidden" name="payments" value={{json_encode($payments)}}>
      <input type="hidden" name="interest_type" value={{json_encode($interestType)}}>
      <input type="hidden" name="total_interest" value="{{json_encode($totalInterest)}}">

      <x-button variant="warning" type="submit" wire:submit.prevent="submit">
        Cotización
      </x-button>
    </form>
    <form action="{{route('pdfEstimate')}}" method="POST" target="_blank">
      @csrf
      <input type="hidden" name="customer" value="{{json_encode($customerSelected)}}">
      <input type="hidden" name="amount" value="{{json_encode($amount)}}">
      <input type="hidden" name="interest" value={{json_encode($interest)}}>
      <input type="hidden" name="payments" value={{json_encode($payments)}}>
      <input type="hidden" name="interest_type" value={{json_encode($interestType)}}>
      <input type="hidden" name="total_interest" value="{{json_encode($totalInterest)}}">

      <x-button variant="success" type="submit" wire:click="save()" wire:submit.prevent="submit">
        Crear Crédito
      </x-button>
    </form>
  </div>
</div>