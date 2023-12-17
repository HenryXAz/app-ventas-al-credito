<div class="overflow-x-auto relative">
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
            <tr>
                <th class="py-3 px-6">No de cuota</th>
                <th class="py-3 px-6">Fecha</th>
                <th class="py-3 px-6">Cuota</th>
                <th class="py-3 px-6">Capital</th>
                <th class="py-3 px-6">Interés</th>
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
                    <span class="text-blue-400">Q. {{ number_format($payment->interest, 2, '.', ',') }}</span>
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

                    <x-button variant="info" 
                        href="{{route('pdfInvoice', [
                            $customerSelected[0]->id,
                            $payment->id
                        ])}}"
                        target="_blank"
                        >
                        Recibo
                    </x-button>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>