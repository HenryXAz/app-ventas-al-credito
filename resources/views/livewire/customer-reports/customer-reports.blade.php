<div class="w-full">

    <h1 class="w-full text-center font-light my-5 text-3xl">Reporte de Clientes</h1>


    <div class="flex gap-4 items-center my-6">
        <div class="flex flex-col gap-2 ">
            ¿Qué desea ver?
            <select name="" id="report" class="dark:bg-dark-eval-2 dark:text-white text-gray-700 bg=white" wire:model="report">
                <option value="1">pagan esta semana</option>
                <option value="2">no pagan esta semana</option>
                <option value="3">morosos</option>
            </select>
        </div>
    </div>

   
    @if(count($credits) > 0)
    <button href="#" class="px-2 py-4 rounded-md text-white bg-indigo-600 hover:bg-indigo-700 ">generar reporte</button>

    <div class="overflow-x-auto relative ">
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
  
                  <th scope="col" class="py-3 px-6">
                      monto
                  </th>
                  <th scope="col" class="py-3 px-6">
                      fecha pago
                  </th>
  
              </tr>
          </thead>
          <tbody>
              @foreach($credits as $credit)
              <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1 ">
                  <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
                    {{$credit->customer->name}} {{$credit->customer->last_name}}
                  </td>

                  <td class="py-4 px-6 text-gray-900 dark:text-white ">
                    <img src="{{asset('storage/' . $credit->customer->photo)}}" alt="customer photo" width="200">
                  </td>
                  <td class="py-4 px-6 text-gray-900  dark:text-white">
                      {{$credit->customer->email}}
                  </td>
                  <td class="py-4 px-6 text-gray-900  dark:text-white">
                      {{$credit->customer->personal_phone}}
                  </td>
        
                  <td class="py-4 px-6 text-gray-900  dark:text-white">
                      Q. {{$credit->nextPayment($credit->id)->fee}}
                  </td>
                  <td class="py-4 px-6 text-gray-900  dark:text-white">
                      {{$credit->nextPayment($credit->id)->payment_date}}
                  </td>

              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <div class="px-6 py-3 w-1/2 mx-auto">
    {{$credits->links()}}
  </div>
    @else 
      <div class="w-full mx-auto my-6 ">
        <p class="text-gray-700 dark:text-white text-center font-light text-xl">
          Nada para mostrar
        </p>
      </div>

    @endif

</div>