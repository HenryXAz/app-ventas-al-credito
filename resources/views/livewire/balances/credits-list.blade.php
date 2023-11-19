@foreach($credits as $credit)
<div class="w-full" wire:key='{{$credit->id}}'>
    <button class="flex flex-col p-4 my-4 w-3/4 mx-auto bg-white rounded-lg dark:bg-dark-eval-3" role="alert"
        wire:click="chooseCredit({{$credit->id}})">
        <div
            class="p-2 text-sm w-full font-medium text-gray-700 dark:text-gray-300 flex justify-between  mx-auto gap-4">
            <h2 class="text-xl">monto de crédito <span class="text-emerald-500">Q. {{number_format($credit->capital, 2,
                    ',', '.')}}</span></h2>
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
                    @if($credit->payment_frequency === "1")
                    Semanal
                    @elseif($credit->payment_frequency === "2")
                    Quincenal
                    @elseif($credit->payment_frequency === "3")
                    Mensual
                    @else
                    {{$credit->payment_frequency}}
                    @endif
                </span></p>
            <img src="{{asset(" storage/" . $credit->car_image)}}" alt="foto vehículo" width="100">

        </div>

        <div class="flex p-2 gap-2 my-2 justify-between w-full mx-auto bg-white rounded-lg dark:bg-dark-eval-3">
            <p>saldo pendiente <span class="text-indigo-700 dark:text-indigo-300">
                    Q. {{number_format($credit->balance, 2, ',', '.')}}
                </span>
            </p>
        </div>
    </button>
</div>
@endforeach