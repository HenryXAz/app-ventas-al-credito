<div class="w-full ">
    <h1 class="w-full text-3xl text-center my-4">Reporte de Ingresos</h1>

    <div class="flex gap-4">
        <div class="flex flex-col">
            Mes:
            <select name="" id="month" class="dark:bg-dark-eval-2 dark:text-white text-gray-700 bg=white" wire:model="month">
                <option value="0">---</option>
                <option value="1">enero</option>
                <option value="2">febrero</option>
                <option value="3">marzo</option>
                <option value="4">abril</option>
                <option value="5">mayo</option>
                <option value="6">junio</option>
                <option value="7">julio</option>
                <option value="8">agosto</option>
                <option value="9">septiembre</option>
                <option value="10">octubre</option>
                <option value="11">noviembre</option>
                <option value="12">diciembre</option>
            </select>
        </div>

        <div class="flex flex-col">
            Año:
            <select name="" id="year" class="dark:bg-dark-eval-2 dark:text-white text-gray-700 bg=white" wire:model="year">
                <option value="0">---</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
                <option value="2031">2031</option>
                <option value="2032">2032</option>
                <option value="2033">2033</option>
                <option value="2034">2034</option>
                <option value="2035">2035</option>
                <option value="2036">2036</option>
                <option value="2037">2037</option>
                <option value="2038">2038</option>
                <option value="2039">2039</option>
                <option value="2040">2040</option>
                <option value="2041">2041</option>
                <option value="2042">2042</option>
                <option value="2043">2043</option>
                <option value="2044">2044</option>
                <option value="2045">2045</option>
                <option value="2046">2046</option>
                <option value="2047">2047</option>
                <option value="2048">2048</option>
                <option value="2049">2049</option>
                <option value="2050">2050</option>
            </select>
        </div>
    </div>

    @if(count($payments) > 0)
    <h2 class="w-full text-2xl my-3 font-light"> ganancias de {{$this->getMonth($month)}} {{$year}}</h2>

    <div class="flex gap-2 justify-between my-4 h-auto">
        <div class="flex flex-col w-1/3 justify-between bg-orange-600 text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
            <p class="text-3xl text-gray-100">Q. {{$capital}}</p>
            <h2 class="text-md text-gray-100">Capital Recuperado</h2>
        </div>

        <div class="flex flex-col w-1/3  justify-between  bg-blue-600 dark:text-white text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
            <p class="text-3xl text-gray-100">Q. {{$interests}}</p>
            <h2 class="text-md text-gray-100">Intereses Percibidos</h2>
        </div>

        <div class="flex flex-col w-1/3 bg-emerald-600 justify-between dark:text-white text-gray-700 text-center h-48 p-2 rounded-md shadow-md">
            <p class="text-3xl text-gray-100">Q. {{$interests * .1}}</p>
            <h2 class="text-md text-gray-100">10% porciento</h2>
        </div>
    </div>

    @else 
        <div class="w-full my-6 text-xl font-light text-center p-4">
            <p>Parece que en este mes no hubo ingresos</p>
        </div>

    @endif
</div>