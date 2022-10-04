<div class="w-full">
  <form class="w-3/4  gap-2">      
    <input type="search" class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" id="search" name="search" placeholder="buscar cliente ">
  </form>


  <button class="w-full">
    <div class="flex flex-col p-4 my-4 w-3/4 mx-auto bg-gray-100 rounded-lg dark:bg-dark-eval-3" role="alert">
    
      <div class="p-2 text-sm w-full font-medium text-gray-700 dark:text-gray-300 flex justify-between  mx-auto gap-4">
        <h2 class="text-xl">monto de crédito <span class="text-emerald-500">Q. 40000</span></h2>
        <p>tipo de interés <span class="text-purple-400">fijo/porcentual</span></p>
      </div>
  
      <div class="flex p-2 my-2 w-full mx-auto bg-gray-100 rounded-lg dark:bg-dark-eval-3">
        <p>frecuencia de pago <span class="text-blue-400">mensual/semanal/quincenal</span></p>
      </div>
      
    </div>
  </button>

  <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="bg-dark-eval-3 text-xs uppercase  dark:bg-dark-eval-1 text-white sticky top-0 ">
      <tr>
        <th class="py-3 px-6">Fecha </th>
        <th class="py-3 px-6">Capital</th>
        <th class="py-3 px-6">Saldo</th>    
      </tr>
    </thead>
    <tbody>
      <tr class="bg-white dark:bg-dark-eval-2 even:bg-purple-100 dark:even:bg-dark-eval-1">
        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
          fecha hoy
        </td>
        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
          Q. monto de crédito solicitado
        </td>
        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap  dark:text-white">
          Q. saldo
        </td>
      </tr>
    </tbody>
  </table>
  
</div>
