<div class="w-full">

    <h1 class="w-full text-center font-light my-5 text-3xl">Reporte de Clientes</h1>


    <div class="flex gap-4">
        <div class="flex flex-col gap-2">
            ¿Qué desea ver?
            <select name="" id="report" class="dark:bg-dark-eval-2 dark:text-white text-gray-700 bg=white" wire:model="report">
                <option value="1">pagan esta semana</option>
                <option value="2">no pagan esta semana</option>
                <option value="3">morosos</option>
            </select>
        </div>
    </div>

    @foreach($payments as $payment)
    <div class="overflow-x-auto relative">
        <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white ">
                <tr class="">

                    <th scope="col" class="py-3 px-6">
                        nombre
                    </th>
                    <th scope="col" class="py-3 px-6">
                        foto de perfil
                    </th>
                    <th scope="col" class="py-3 px-6">
                        email
                    </th>

                    <th scope="col" class="py-3 px-6">
                        teléfono
                    </th>
                    @if($report !== "2")
                    <th scope="col" class="py-3 px-6">
                        monto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        fecha pago
                    </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                        {{$customer->name}} {{$customer->last_name}}
                    </td>

                    <td class="py-4 px-6 text-gray-900 dark:text-white ">
                        <img src="{{ asset("storage/" .$payment->credits->first()->customer->first()->photo )}}" alt="perfil image" width="100">
                    </td>
                    <td class="py-4 px-6 text-gray-900  dark:text-white">
                        {{$customer->email}}
                    </td>
                    <td class="py-4 px-6 text-gray-900  dark:text-white">
                        {{$customer->personal_phone}}
                    </td>
                    @if($report !== "2")
                    <td class="py-4 px-6 text-gray-900  dark:text-white">
                        Q. {{$payment->fee}}
                    </td>
                    <td class="py-4 px-6 text-gray-900  dark:text-white">
                        {{$payment->payment_date}}
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

</div>