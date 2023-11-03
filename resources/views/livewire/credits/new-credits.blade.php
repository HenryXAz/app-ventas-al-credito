<div class="w-full">
  <h1 class="text-xl">Nuevo Crédito</h1>

  @if(session()->has("message"))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
    class="w-2/4 mx-auto bg-green-300 dark:bg-teal-700 text-center p-4 rounded-md dark:text-white text-gray-700">
      <h3 class="text-md">{{ session("message")}}</h3>
    </div>
  @endif

  @if(!$estimate)
    @include('livewire.credits.estimate-form')
  @endif

  @if($estimate)
    @include('livewire.credits.estimate-table')
  @endif

</div>