<div class="w-full mx-auto" >
   

  <!-- Main modal -->
  <div id="defaultModal" tabindex="-1" aria-hidden="true" class="dark:bg-gray-200/20 bg-gray-400/40 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full md:w-1/2 mx-auto h-full md:h-auto">
          <!-- Modal content -->
      <div class="flex flex-col p-4 relative mx-auto w-full bg-white rounded-lg shadow dark:bg-dark-eval-1">
      
      @if(session()->has("emailExists"))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="w-2/4 mx-auto  bg-red-500 text-center p-4 rounded-md text-white">
          <h3 class="text-md">{{ session("emailExists")}}</h3>
        </div>
      @endif


      {{-- form--}}

      {{-- name --}}
      <div class="flex flex-col w-full gap-2 my-2">
        <input type="text" id="name" class="w-full mr-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
          placeholder="nombre" wire:model="name" required >
        <x-jet-input-error for="name"/>
      </div>  

      {{-- email --}}
      <div class="flex flex-col w-full gap-2 my-2">
        <input type="email" id="email" class="w-full mr-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
          placeholder="correo electrónico" wire:model="email" required >
        <x-jet-input-error for="email"/>
      </div>

      <div  class="w-full my-4 flex gap-2">
        Rol
        <select id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          wire:model="role">
          <option value="1" >administrador</option>
          <option value="2" >vendedor</option>
          <option value="3" >secretaria</option>
        </select>
  
      </div>

      {{-- password --}}
      <div class="flex flex-col w-full gap-2 my-2">
        <input type="password" id="password" class="w-full mr-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
          placeholder="contraeña" wire:model="password" required >
        <x-jet-input-error for="password"/>
      </div>

      {{-- confirm parssword --}}
      <div class="flex flex-col w-full gap-2 my-2">
        <input type="password" id="confirm-password" class="w-full mr-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" 
          placeholder="confirmar contraseña" wire:model="confirmPassword" required >
        <x-jet-input-error for="confirmPassword"/>
      </div>


      {{-- buttons form --}}
      <div class="flex items-center p-6 space-x-2 rounded-b w-full mx-auto flex-col gap-2 flex-center justify-center">
        <x-button variant="success" wire:required.attr="disabled" wire:loading.attr="disabled" wire:target="name" 
          wire:click="save()">guardar usuario</x-button>
        {{-- <button data-modal-toggle="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button> --}}
        <button wire:click="cleanFields()" type="button" class=" text-gray-500 bg-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-4 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
          cancelar</button>
      </div>
      
      </div>   
    </div>
  </div>
</div>
