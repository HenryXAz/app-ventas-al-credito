<div class="p-4 h-auto"> 

  <button wire:click="toggleModal()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="defaultModal">
    Toggle modal
  </button>

  @if($modal)

  @include("livewire.customers.add-customers")

  @endif

  {{$name}}

  {{$isMarried}}

  {{$rent}}

</div>
