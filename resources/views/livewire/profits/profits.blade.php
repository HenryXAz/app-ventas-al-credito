<div class="w-full ">
    <h1 class="w-full text-3xl text-center font-light my-4">Reporte de Ingresos</h1>

    <div class="flex flex-col md:flex-row gap-5">
        <div class="flex flex-col md:flex-row gap-4">
            <label  for="start_date">Fecha Inicial:</label>
            <input class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" type="date" name="start_date" id="start_date" wire:model="start_date">
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <label for="end_date">Fecha Final:</label>
            <input class="w-full mr-2 my-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" type="date" name="end_date" id="end_date" wire:model="end_date">
        </div>
    </div>

    @if(!is_null($statistics[0]->profits))
    <h2 class="w-full text-sm md:text-2xl my-3 font-light"> 
        ganancias del {{\Carbon\Carbon::parse($start_date)->format('d-m-Y')}} hasta {{\Carbon\Carbon::parse($end_date)->format('d-m-Y')}} </h2>

        <div class="flex gap-2 justify-center  md:flex-row flex-col items-center sm:flex-row sm:justify-center my-4 h-auto flex-nowrap">
            <div class="flex flex-col sm:w-1/3 md:w-1/3 w-full justify-between bg-orange-600 text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
                <p class="text-3xl text-gray-100">Q. {{number_format($statistics[0]->recovered_capital, 2, '.', ',')}} </p>
                <h2 class="text-md text-gray-100">Capital Recuperado</h2>
            </div>
    
            <div class="flex flex-col sm:w-1/3 md:w-1/3 w-full  justify-between  bg-blue-600 dark:text-white text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
                <p class="text-3xl text-gray-100">Q. {{number_format($statistics[0]->profits, 2, '.', ',')}}</p>
                <h2 class="text-md text-gray-100">Intereses Percibidos</h2>
            </div>
    
            <div class="flex flex-col sm:w-1/3 md:w-1/3 w-full bg-emerald-600 justify-between dark:text-white text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
                <p class="text-3xl text-gray-100">Q. {{number_format($statistics[0]->ten_percent_of_profits, 2, '.', ',')}}</p>
                <h2 class="text-md text-gray-100">10% porciento</h2>
            </div>
        </div>
    @else 
    <div class="w-full my-6 text-xl font-light text-center p-4">
        <p class="text-sm md:text-lg">Parece que en estas fechas no hubo ingresos</p>
    </div>
    @endif
</div>