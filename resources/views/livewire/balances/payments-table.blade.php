<div class="overflow-x-auto relative">
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
            <tr>
                <th class="py-3 px-6">No de cuota</th>
                <th class="py-3 px-6">Fecha</th>
                <th class="py-3 px-6">Cuota</th>
                <th class="py-3 px-6">Capital</th>
                <th class="py-3 px-6">Mora</th>
                <th class="py-3 px-6">Saldo</th>
                <th class="py-3 px-6"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)

            <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1">
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    {{ $payment->payment_number }}
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    Q. {{ number_format($payment->fee, 2, '.', ',') }}
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    <span class="text-blue-400">Q. {{ number_format($payment->capital, 2, '.', ',') }}</span>
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    <span class="text-blue-400">Q. {{ number_format($payment->financial_default, 2, '.', ',') }}</span>
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    Q. {{ number_format($payment->balance , 2, '.', ',')}}
                </td>
                <td class="flex gap-2 py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">

                    @if($payment->method_payment == '2')
                    <x-button href="{{asset('storage/' . $payment->certification_payment)}}" target="_blank">
                        comprobante
                    </x-button>
                    @endif

                    <form action='{{ route("pdfInvoice") }}' method="POST" target="_blank">
                        @csrf

                        <input type="hidden" name="nameCustomer" value="{{json_encode($customerSelected[0]->name)}}" />
                        <input type="hidden" name="lastNameCustomer"
                            value="{{json_encode($customerSelected[0]->last_name)}}" />
                        <input type="hidden" name="dpiCustomer" value="{{json_encode($customerSelected[0]->dpi)}}" />
                        <input type="hidden" name="paymentNumber" value="{{json_encode($payment->payment_number)}}" />
                        <input type="hidden" name="paymentDate" value="{{json_encode($payment->payment_date)}}" />
                        <input type="hidden" name="fee" value="{{json_encode($payment->fee)}}" />
                        <input type="hidden" name="method_payment" value="{{json_encode($payment->method_payment)}}" />
                        <input type="hidden" name="paymentDay" value="{{json_encode($payment->payment_day)}}" />
                        <input type="hidden" name="financialDefault"
                            value="{{json_encode($payment->financial_default)}}">
                        <input type="hidden" name="balance" value="{{json_encode($payment->balance)}}">
                        <input type="hidden" name="receivedBy" value="{{json_encode(Auth::user()->name)}}">
                        <x-button variant="info" type="submit" wire:submit.prevent="submit">
                            recibo
                        </x-button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>