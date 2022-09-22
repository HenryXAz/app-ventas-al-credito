<div class=" z-10  ease-out duration-400 w-autoh-full">
  <div class="w-full h-full flex justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class=" inset-0 transition-opacity w-full  ">
      {{-- <div class="absolute w-full bg-gray-500 opacity-75 h-full">

      </div> --}}

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen">

      </span> 

      <div class="mx-auto w-1/2 inline-block align-bottom bg-white rounded-lg text-left  shadow-x1 transform transition-all sm:m-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form class="rounded w-full">

          {{-- form inputs --}}

        
          <div class="flex flex-col w-full">

            <div class="flex">


             <div>

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="dpi" class="block text-gray-700 text-sm font-bold mb-2">DPI: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="dpi" wire:model="dpi">
                </div>
              </div>
    
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="name" wire:model="name">
                </div>
              </div>
    
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="lastName" class="block text-gray-700 text-sm font-bold mb-2">Apellido: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="lastName" wire:model="lastName">
                </div>
              </div>
    
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="personalPhone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Personal: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="personalPhone" wire:model="personalPhone">
                </div>
              </div>
    
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="homePhone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono de Domicilio: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="homePhone" wire:model="homePhone">
                </div>
              </div>
    

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="phoneReference" class="block text-gray-700 text-sm font-bold mb-2">Teléfono de Referencia: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="phoneReference" wire:model="phoneReference">
                </div>
              </div>
    
    

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="emailReference" class="block text-gray-700 text-sm font-bold mb-2">Email de Referencia: </label>
                  <input type="email" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="emailReference" wire:model="emailReference">
                </div>
              </div>

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="nameReference" class="block text-gray-700 text-sm font-bold mb-2">Nombre Referencia: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="nameReference" wire:model="nameReference">
                </div>
              </div>

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="lastNameReference" class="block text-gray-700 text-sm font-bold mb-2">Apellido Referencia: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="lastNameReference" wire:model="lastNameReference">
                </div>
              </div>
    
    
    
           
    

             </div>
              
             
             
             <div>

              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mb-1">
                  <label for="employmentPhone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono de Trabajo: </label>
                  <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="employmentPhone" wire:model="employmentPhone">
                </div>
              </div>


                <div class="px-6 mt-7">es casado: 
                  <input id="default-radio-1" type="checkbox" value="" name="si" wire:model="isMarried" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                </div>

                <div class="px-6 py-5">alquila:    
                  <input id="default-radio-1" type="checkbox" value="" name="rent" wire:model="rent" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>

                

               
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="companyName" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Empresa: </label>
                    <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="companyName" wire:model="companyName">
                  </div>
                </div>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="employmentAddress" class="block text-gray-700 text-sm font-bold mb-2">Dirección de la Empresa: </label>
                    <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="employmentAddress" wire:model="employmentAddress">
                  </div>
                </div>
  

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="homeAddress" class="block text-gray-700 text-sm font-bold mb-2">Dirección Domiciliar: </label>
                    <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="homeAddress" wire:model="homeAddress">
                  </div>
                </div>


                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo: </label>
                    <input type="email" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="email" wire:model="email">
                  </div>
                </div>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="facebook" class="block text-gray-700 text-sm font-bold mb-2">Facebook: </label>
                    <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="facebook" wire:model="facebook">
                  </div>
                </div>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="mb-1">
                    <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Foto: </label>
                    <input type="text" class="border-blue-400 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="photo" wire:model="photo">
                  </div>
                </div>

              
                
  
  


              </div>


        

            </div>


            



          <div>
            <div class="px-4 py-3 sm:px-6 sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button wire:click.prevent="save()" type="button" class="inline-flex justify-center mb-2 w-full rounded-md border border-transparent px-4 py-2 text-white bg-emerald-600 focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">guardar</button>
              </span>

              <span class=" flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button wire:click.prevent="toggleModal()" type="button" class="text-white mt-2 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-400 focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">cancelar</button>
              </span>
            </div>
          </div>

        </div>

        </form>
      </div>
    </div>
  </div>
</div>