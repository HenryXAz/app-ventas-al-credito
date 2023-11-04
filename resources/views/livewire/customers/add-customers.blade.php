<div class="w-full mx-auto" >


  <!-- Main modal -->
  <div id="defaultModal" tabindex="-1" aria-hidden="true" class="mx-auto bg-gray-300/60 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal h-full justify-center items-center">
      <div class="relative p-4 w-full mx-auto h-full md:h-auto">
          <!-- Modal content -->
          <div class="flex flex-col p-4 relative mx-auto w-full  bg-white rounded-lg shadow dark:bg-dark-eval-1">

            {{-- form --}}

            <div class="flex flex-col md:flex-row mb-4 gap-2">

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                  <input type="text" id="dpi" class="w-full mr-2 bg-gray-50 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                  placeholder="DPI" wire:model.live="dpi" required >
                <x-input-error for="dpi"/>
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="nit" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="NIT"  wire:model.live="nit" required >
                <x-input-error for="nit" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="name" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="nombres" wire:model.live="name" required >
                <x-input-error for="name" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="lastName" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="apellidos" wire:model.live="lastName" required >
                <x-input-error for="lastName" />
              </div>

            </div>

            <div class="flex flex-col md:flex-row mb-4 gap-2">

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="personalPhone" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Número Personal" wire:model.live="personalPhone" required >
                <x-input-error for="personalPhone" />
              </div>


              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="homePhone" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Teléfono de Domicilio" wire:model.live="homePhone" required >
                <x-input-error for="homePhone" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="employmentPhone" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Teléfono de trabajo" wire:model.live="employmentPhone" required >
                <x-input-error for="employmentPhone" />
              </div>



            </div>

            <div class="flex flex-col md:flex-row mb-4 gap-2">

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="companyName" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Empresa" wire:model.live="companyName" required >
                <x-input-error for="companyName" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="employmentAddress" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Dirección de Empresa" wire:model.live="employmentAddress" required>
                <x-input-error for="employmentAddress" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="homeAddress" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Dirección de Domicilio" wire:model.live="homeAddress" required >
                <x-input-error for="homeAddress" />
              </div>

            </div>


            <div class="flex flex-col md:flex-row mb-4 gap-2 justify-center">

              <div class="flex flex-col w-full md:w-1/2 gap-2">
                <input type="text" id="facebook" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Facebook" wire:model.live="facebook" required >
                <x-input-error for="facebook" />
              </div>

              <div class="flex flex-col w-full md:w-1/2 gap-2">
                <input type="email" id="email" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Correo Electrónico" wire:model.live="email" required >
                <x-input-error for="email" />
              </div>

            </div>

            <div class="flex flex-col md:flex-row mb-4 gap-2">
              

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="nameReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Nombre de Referencia" wire:model.live="nameReference" required >
                <x-input-error for="nameReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="lastNameReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Apellido de Referencia" wire:model.live="lastNameReference" required >
                <x-input-error for="lastNameReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="email" id="emailReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Correo Electrónico de Referencia" wire:model.live="emailReference" required >
                <x-input-error for="emailReference" />
              </div>

            </div>

            <div class="flex  mb-4 gap-2 justify-center">

              <div class="flex flex-col w-full gap-2">
                <input type="text" id="phoneReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Teléfono de Referencia" wire:model.live="phoneReference" required >
                <x-input-error for="phoneReference" />
              </div>

            </div>

            <h2 class="text-md dark:text-purple-400 text-purple-900">otras referencias(opcional)</h2>

            
            <div class="flex flex-col md:flex-row mb-4 mt-6 gap-2">

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="nameSecondReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Nombre Segunda Referencia" wire:model.live="nameSecondReference" >
                <x-input-error for="nameSecondReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="lastNameSecondReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Apellido Segunda Referencia" wire:model.live="lastNameSecondReference"  >
                <x-input-error for="lastNameSecondReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="emailSecondReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Email Segunda Referencia" wire:model.live="emailSecondReference"  >
                <x-input-error for="emailSecondReference" />
              </div>

            </div>

            <div class="flex flex-col md:flex-row mb-4 gap-2">

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="phoneSecondReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Teléfono Segunda Referencia" wire:model.live="phoneSecondReference"  >
                <x-input-error for="phoneSecondReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="nameThirdReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Nombre Tercera Referencia" wire:model.live="nameThirdReference"  >
                <x-input-error for="nameThirdReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/3 gap-2">
                <input type="text" id="lastNameThirdReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Apellido Tercera Referencia" wire:model.live="lastNameThirdReference"  >
                <x-input-error for="lastNameThirdReference" />
              </div>

            </div>

            <div class="flex flex-col md:flex-row mb-4  gap-2 justify-center">

              <div class="flex flex-col w-full md:w-1/2 gap-2">
                <input type="text" id="emailThirdReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Email Tercera Referencia" wire:model.live="emailThirdReference"  >
                <x-input-error for="emailThirdReference" />
              </div>

              <div class="flex flex-col w-full md:w-1/2 gap-2">
                <input type="text" id="phoneThirdReference" class="w-full mr-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block  p-2.5 dark:bg-dark-eval-2 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                placeholder="Teléfono Tercera Referencia" wire:model.live="phoneThirdReference"  >
                <x-input-error for="phoneThirdReference" />
              </div>
              
            </div>


            <div class="flex mb-4 md:flex-row flex-col">

              <div class="px-6 my-5">es casado:
                <input id="default-radio-1" type="checkbox" value="" name="si" wire:model.live="isMarried" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

              </div>

              <div class="px-6 py-5">alquila:
                <input id="default-radio-1" type="checkbox" value="" name="rent" wire:model.live="rent" class="w-4 h-4 text-blue-600 bg-gray-200 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              </div>

              <div class="flex flex-col w-full">

                <div wire:loading wire:target="photo" class="w-1/3 text-center mx-auto bg-gray-200 dark:bg-dark-eval-1 text-amber-600 mb-3 ">cargando imagen...</div>


                @if($profileImage && !$photo)
                  <img src="{{asset("storage/" . $profileImage)}}" alt="profile photo" class="w-1/2 mx-auto object-cover">

                @endif


            @if($photo)
              <img src="{{$photo->temporaryUrl() ?? ""}}" alt="profile photo" class="w-1/2 mx-auto object-cover">
            @endif


              @if($photo)
              <x-button wire:click="removeImage()" variant="secondary" class="w-1/4 mx-auto dark:bg-dark-eval-3">eliminar imagen...</x-button>
              @endif

              @if(!$photo)
              <div class="flex justify-center items-center md:w-2/4 w-full mx-auto mt-4">
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-full  bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                  <div class="flex flex-col justify-center items-center pt-5 pb-6">
                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir un archivo de imagen </span></p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    <p class="text-md text-amber-700 dark:text-amber-400 mt-2">fotografía de cliente</p>
                  </div>
                  <input id="dropzone-file" type="file" class="hidden" wire:model.live.live="photo">
                </label>
              </div>
              <x-input-error for="dropzone-file"/>



              @endif
            </div>


            </div>

              <!-- Modal footer -->
              <div class="flex flex-col md:flex-row gap-2 items-center p-6 space-x-2 rounded-b w-full mx-auto flex-center justify-center">

                <x-button variant="success"  wire:click="save()" wire:attr="disabled" wire:target="save, photo | profileImage"  
                >
                Guardar
                </x-button>

                  <button wire:click="toggleModal()"  type="button" class=" text-gray-500 bg-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">cancelar</button>
              </div>
          </div>
      </div>
  </div>

  </div>
