<div class="w-full ">
 {{-- message for deleting user authenticated error --}}

 @if(session()->has("authenticadedUserDeleted"))
 <div
  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"  
  class="flex w-3/4 mx-auto  rounded-lg bg-white dark:bg-dark-eval-1 " role="alert">

  <div class="w-10 bg-red-600 flex justify-center py-4 rounded-l-md">
    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 bg-red-600 text-white dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
  </div>

  <div class="ml-3 text-sm font-medium py-4  text-gray-700 dark:text-gray-300">
    {{session("authenticadedUserDeleted")}}
  </div>
</div>
 @endif

  <div  class="flex p-5 w-3/4 my-4 mx-auto bg-white rounded-lg dark:bg-dark-eval-0" role="alert">
  
    <div class="ml-3 w-full text-xl flex justify-between font-medium text-gray-700 dark:text-gray-300">
      <p>Usuario Activo <span class="dark:text-emerald-500 text-emerald-700">{{Auth::user()->name}}</span></p>  
      <p>Rol <span class="dark:text-blue-400 text-blue-700">
        @if(Auth::user()->role === self::ADMIN)
        administrador
        @elseif(Auth::user()->role == self::SELLER)
          vendedor
        @elseif(Auth::user()->role === self::SECRETARY)
          secretaria
        @endif  
      </span></p>    
    </div>
  </div>

 

  @if($alertDelete)
    @include("livewire.users.confirm-delete")
  @endif

  @if($modal)
    @include("livewire.users.add-user")
  @endif

  <div class="w-full mx-auto flex gap-2">
    <x-button wire:click="$set('modal', true)" variant="primary" >nuevo usuario</x-button>

    <label for="default-search" class="  mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
    <div class="relative w-3/4">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <form action="GET">
          <input type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="buscar usuario..." wire:model="search">    
        </form>  
      
    </div>
  </div>

  <div class="overflow-x-auto relative">
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white ">
          <tr class="">

              <th scope="col" class="py-3 px-6">
                  nombre
              </th>
              <th scope="col" class="py-3 px-6">
                  email
              </th>
              <th scope="col" class="py-3 px-6">
                  rol
              </th>
              <th scope="col" class="py-3 px-6"></th>
          </tr>
      </thead>
      <tbody >
        @foreach($users as $user)
        
          @if(Auth::user()->email === $user->email)
            
          @endif

          <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                 {{$user->name}}
              </td>
              <td class="py-4 px-6 text-gray-900 dark:text-white ">
                  {{$user->email}}
              </td>
              <td class="py-4 px-6 text-gray-900 dark:text-white ">
                @if($user->role === self::ADMIN)
                  <div class="p-2 min-w-full dark:text-white  text-gray-700 text-center w-1/2 border-2 border-purple-600 rounded-md">
                    administrador
                  </div>
                @elseif($user->role === self::SELLER)
                <div class="p-2 dark:text-white min-w-full text-gray-700 text-center w-1/2 border-2 border-blue-600 rounded-md">
                  vendedor
                </div>
                @elseif($user->role === self::SECRETARY)
                <div class="p-2 dark:text-white min-w-full text-gray-700 text-center w-1/2 border-2 border-emerald-600 rounded-md">
                  secretaria
                </div>
                @endif
              </td>
              <td class="flex gap-2 items-center justify-center p-2">
                <x-button variant="warning" wire:click="edit('{{$user->id}}')">
                  editar
                </x-button>
                <x-button variant="danger" wire:click="confirmDelete({{$user->id}})">
                  eliminar
                </x-button>
              </td>
              </td>
          </tr>
          @endforeach


          
      </tbody>
    </table>
  </div>
</div>
