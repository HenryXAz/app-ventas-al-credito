<div class="p-4 h-auto"> 

  <button wire:click="toggleModal()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="defaultModal">
    Toggle modal
  </button>

  @if($modal)

  @include("livewire.customers.add-customers")

  @endif

    @if(!$modal)

    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-white ">
          <tr>
              <th scope="col" class="py-3 px-6">
                  nombre
              </th>
              <th scope="col" class="py-3 px-6">
                  apellido
              </th>
              <th scope="col" class="py-3 px-6">
                  telefono
              </th>
              <th scope="col" class="py-3 px-6">
                  email
              </th>
          </tr>
      </thead>
      <tbody>
        @foreach($customers as $customer)
          <tr class="bg-white border-b ">
              <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                 {{$customer->name}}
              </td>
              <td class="py-4 px-6 text-gray-900 ">
                  {{$customer->last_name}}
              </td>
              <td class="py-4 px-6 text-gray-900 ">
                {{$customer->personal_phone}}
              </td>
              <td class="py-4 px-6 text-gray-900 ">
                  {{$customer->email}}
              </td>
          </tr>
          @endforeach
          
      </tbody>
    </table>
  
    @endif


  </div>
