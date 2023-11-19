<div class="flex flex-col p-4 my-4 w-full mx-auto bg-white rounded-lg dark:bg-dark-eval-1">
    <button type="button"
        class="ml-auto -mx-1.5 -my-1.5 bg-gray-100 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex h-8 w-8 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white"
        data-dismiss-target="#alert-5" aria-label="Close" wire:click="unSelectCredit()">
        <span class="sr-only">Dismiss</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="flex flex-col p-1 my-5 w-full">
        <div class="flex gap-2 w-full justify-center">
            <p class="font-light text-md md:text-xl">Número de pago: {{$creditPaymentInfo[0]->payment_number}}</p>
        </div>

        @if($creditPaymentInfo[0]->days_late < 0) <div>
            <p class="font-light text-center text-red-700 dark:text-red-400 text-md md:text-xl">
                Este pago está atrasado {{($creditPaymentInfo[0]->days_late * -1)}} días
            </p>
    </div>
    @endif


    <div class="flex gap-2 w-full justify-center">
        <label for="current_date" class="w-full">
            Fecha de hoy:
            <input type="text" name="current_date" id="current_date"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="{{\Carbon\Carbon::today('America/Guatemala')->format('d-m-Y')}}" disabled>
        </label>
        <label for="payment_date" class="w-full">
            Fecha límite:
            <input type="text" name="payment_date" id="payment_date"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="{{\Carbon\Carbon::parse($creditPaymentInfo[0]->current_payment_date)->format('d-m-Y')}}"
                disabled>
        </label>
    </div>

    <div class="flex gap-2 w-full justify-center">
        <label for="interest" class="w-full">
            Interés:
            <input type="text" name="interest" id="interest"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="Q. {{number_format($creditPaymentInfo[0]->interest_amount, 2, '.', ',')}}" disabled>
        </label>
        <label for="financial_default" class="w-full">
            Mora:
            <input type="text" name="financial_default" id="financial_default"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="Q. {{number_format($creditPaymentInfo[0]->financial_default_amount, 2, '.', ',')}}" disabled>
        </label>
    </div>

    <div class="flex gap-2 w-full justify-center">
        <label for="new_balance" class="w-full">
            Saldo después de pagar:
            <input type="text" name="new_balance" id="new_balance"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="Q. {{number_format($creditPaymentInfo[0]->new_balance, 2, '.', ',')}}" disabled>
        </label>

        <label for="recovered_capital" class="w-full">
            Capital recuperado:
            <input type="text" name="recovered_capital" id="recovered_capital"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                value="Q. {{number_format($creditPaymentInfo[0]->recovered_capital, 2, '.', ',')}}" disabled>
        </label>

    </div>

    <div class="flex  py-2 rounded-md justify-center items-center gap-2 w-full my-5 justify-center">
        <label for="fee" class="w-1/2">
            Cuota:
            <input type="text" name="fee" id="fee"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                wire:model.live="fee">
            <x-input-error for="fee" />
        </label>
        <x-button variant="primary" wire:click='recalculatePaymentFee()'>
            recalcular
        </x-button>
    </div>

    @if(Auth::user()->role == '1')
    <p class="mt-5 mb-2 text-red-700 dark:text-red-400 font-light text-center">
        **Opción válida solo para administradores**
    </p>
    <div class="flex rounded-md py-2 items-center gap-2 w-full my-5 justify-center">
        <label for="custom_financial_default" class="w-1/2">
            Mora extraordinaria:
            <input type="text" name="custom_financial_default" id="custom_financial_default"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                wire:model.live="customFinancialDefault">
            <x-input-error for="customFinancialDefault" />
        </label>
        <x-button variant="warning" wire:click='recalculateFinancialDefault()'>
            recalcular
        </x-button>
    </div>
    @endif

    <div class="w-full my-5 flex gap-2">
        Tipo de pago:
        <select id="payment_method"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-dark-eval-1 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            wire:model.live="paymentMethod">
            <option value="1">efectivo</option>
            <option value="2">banco</option>
        </select>
    </div>

    @if($paymentCertification !== null)
    <img src="{{$paymentCertification->temporaryUrl()}}" alt="comprobante de pago" width="200"
        class="w-1/2 mx-auto object-cover">

    <div class="w-full flex justify-center">
        <button wire:click="removeImage('1')"
            class="w-1/4 p-2.5 text-center  dark:bg-dark-eval-1 bg-gray-100 text-gray-800 dark:text-white rounded-md ">eliminar
            imagen...</button>
    </div>
    @endif

    @if($paymentMethod === "2" && $paymentCertification === null)
    <div class=" my-4 flex justify-center items-center w-2/4 mx-auto ">
        <label for="dropzone-file"
            class="flex flex-col justify-center items-center w-full  bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir un
                        archivo de imagen </span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" wire:model.live="paymentCertification" required>
            <span class="dark:text-rose-300 text-rose-500">comprobante requerido</span>
        </label>

    </div>
    @endif

    @if($paymentMethod == '2')
    <div class="flex justify-center items-center my-5 gap-2">

        <label for="bank_name">
            Banco:
            <select id="bank_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-dark-eval-1 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                wire:model.live="bankName">
                <option value="Banrural">Banrural</option>
                <option value="BI">Banco Industrial</option>
                <option value="GTContinental">G&T Continental</option>
                <option value="BAM">BAM</option>
                <option value="Ficohsa">Ficohsa</option>
            </select>
        </label>

        {{ $bankName}}
        <label for="bank_id" class="w-1/2">
            Número de pago banco:
            <input type="text" name="bank_id" id="bank_id"
                class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                wire:model.live="bankId">
        </label>

    </div>

    @if(session()->has("error_bank_payment_method"))
    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="font-light md:w-full w-1/2 mx-auto p-2 mt-2 mb-5 rounded-md text-center bg-red-500 text-gray-200">
        {{session('error_bank_payment_method')}}
    </p>
    @endif

    @if(session()->has("error_when_making_payment"))
    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="font-light w-1/2 mx-auto p-2 mt-5 rounded-md text-center bg-red-500 text-gray-200">
        {{session('error_when_making_payment')}}
    </p>
    @endif

    @endif

    @if(session()->has('successful_payment'))
    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="font-light w-1/2 mx-auto p-2 mt-5 rounded-md text-center bg-emerald-700 text-gray-200">
        {{session('successful_payment')}}
    </p>
    @endif

    @if(session()->has('error_when_making_payment'))
    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="font-light w-1/2 mx-auto p-2 mt-5 rounded-md text-center bg-red-500 text-gray-200">
        {{session('error_when_making_payment')}}
    </p>
    @endif

    <div class="flex gap-2 justify-end">
        <x-button variant="success" type="button" wire:click='makePayment()'>
            realizar pago
        </x-button>
        <x-button type="button" variant="danger" wire:click='calculatePayment()'>
            reiniciar
        </x-button>
    </div>
</div>
</div>