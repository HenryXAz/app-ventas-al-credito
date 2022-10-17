<div class="p-4 h-auto">
  
  <div class="w-full mx-auto flex gap-2">
    <x-button wire:click="toggleModal()" variant="primary" >nuevo cliente</x-button>

    <label for="default-search" class="  mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
    <div class="relative w-3/4">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <form action="GET">
          <input type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="buscar cliente..." wire:model="search">    
        </form>  
      
    </div>
  </div>
  

  
  @if($alertDelete)
  @include("livewire.customers.dialog-delete")
  @endif

  @if($modal)

  @include("livewire.customers.add-customers")


  @endif

    @if(!$modal)

    <form action="{{route("customersReport")}}" method="POST" target="_blank">
      @csrf
      <button type="submit" wire:submit.prevent="submit" class="bg-indigo-500 hover:bg-indigo-600 p-3 rounded-md mt-6">generar reporte</button>
    </form>
    <div class="overflow-x-auto relative">
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white ">
          <tr class="">

              <th scope="col" class="py-3 px-6">
                  nombre
              </th>
              <th scope="col" class="py-3 px-6">
                  apellido
              </th>
              <th scope="col" class="py-3 px-6">
                  foto de perfil
              </th>
              <th scope="col" class="py-3 px-6">
                  email
              </th>
              <th scope="col" class="py-3 px-6">

              </th>
          </tr>
      </thead>
      <tbody >
        @foreach($customers as $customer)
          <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                 {{$customer->name}}
              </td>
              <td class="py-4 px-6 text-gray-900 dark:text-white ">
                  {{$customer->last_name}}
              </td>
              <td class="py-4 px-6 text-gray-900 dark:text-white ">
                <img src="{{ asset("storage/" .$customer->photo )}}" alt="perfil image" 
                width="100" >
              </td>
              <td class="py-4 px-6 text-gray-900  dark:text-white">
                  {{$customer->email}}
              </td>
              <td class="py-4 px-6 text-gray-900 flex gap-2 dark:text-white">
                <x-button variant="warning" wire:click="edit({{$customer->id}})">
                  editar
                </x-button>
                <x-button variant="danger" wire:click="toggleAlertDelete({{$customer->id}})">
                  eliminar
                </x-button>
              </td>
          </tr>
          @endforeach


          
      </tbody>
    </table>
  </div>
    @endif

    <div class="px-6 py-3 w-1/2 mx-auto">
      {{$customers->links()}}
    </div>

  </div>
