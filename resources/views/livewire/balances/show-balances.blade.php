<div>
  <h2 class="my-5 font-light text-md lg:text-2xl">Saldo Clientes</h2>

  <input type="text" id="search"
    class="w-full mr-2 mt-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
    wire:model.live="search" placeholder="cliente">

  @if($customers !== null)
  @include('livewire.balances.customers-search-results')
  @endif

  <div>
    @if($customerSelected !== null)
    @include('livewire.balances.customer-selected-card')

    @if($credit !== null && $credit->status == '2')
    @include('livewire.balances.no-more-payments-card')
    @endif

    @if($credit !== null && $credit->status == '1')
    @include('livewire.balances.make-payment-card')
    @endif

    @if(count($payments) > 0)
    @include('livewire.balances.payments-table')
    @endif

    @if(count($payments) == 0 && $credit !== null)
    <div>
      <p class="font-md md:font-lgfont-light text-center my-4">No se han realizado pagos para este crédito</p>
    </div>
    @endif

    <div>
      @if( count($credits) > 0 )
      @include('livewire.balances.credits-list')
      @endif
    </div>

    @if(count($credits) == 0 && $credit === null)
    <p class="text-center text-md md:text-xl font-light">No se encontraron créditos para este cliente</p>
    @endif

    @endif
  </div>
</div>