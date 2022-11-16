

<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="mx-auto bg-gray-300/60 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal h-full justify-center items-center">
    <div class="relative p-4 w-full  h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative mx-auto w-full lg:w-1/4 bg-white rounded-lg shadow dark:bg-gray-700 ">
            <!-- Modal header -->
            
            <!-- Modal body -->
            <div class="p-6  w-full mx-auto">
                <p class="dark:text-white text-md text-gray-700  ">
                  Está seguro que desea eliminar el registro
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex flex-col sm:flex-row gap-2 items-center p-6 space-x-2 justify-center rounded-b dark:border-gray-600">
                <x-button variant="danger" wire:click="delete({{$this->id_customer}})">eliminar</x-button>
                <button wire:click="toggleAlertDelete()" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">cancelar</button>
            </div>
        </div>
    </div>
</div>

