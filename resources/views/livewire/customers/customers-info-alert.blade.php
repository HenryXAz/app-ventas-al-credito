<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="mx-auto bg-gray-300/60 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal h-full justify-center items-center">
  <div class="relative p-4 w-full  h-full md:h-auto">
      <!-- Modal content -->
      <div class="relative mx-auto w-full lg:w-1/4 bg-white rounded-lg shadow dark:bg-gray-700 ">
          <!-- Modal header -->
          
          <!-- Modal body -->
          <div class="p-6  w-full mx-auto">
              <p class="dark:text-white text-center text-md text-gray-700  ">
                desea generar un documento de inscripción
              </p>
          </div>
          <!-- Modal footer -->
          <div class="flex flex-col sm:flex-row gap-2 items-center p-6 space-x-2 justify-center rounded-b dark:border-gray-600">
              <form action="{{route('customersInfo')}}" method="POST" target="_blank">
                @csrf
              
                <input type="hidden" name="id" value="{{$id_customer}}">
                <input type="hidden" name="name" value="{{json_encode($name)}}">
                <input type="hidden" name="last_name" value="{{json_encode($lastName)}}">
                <input type="hidden" name="dpi" value="{{json_encode($dpi)}}">
                <input type="hidden" name="nit" value="{{json_encode($nit)}}">
                <input type="hidden" name="personalPhone" value="{{json_encode($personalPhone)}}">
                <input type="hidden" name="homePhone" value="{{json_encode($homePhone)}}">
                <input type="hidden" name="employmentPhone" value="{{json_encode($employmentPhone)}}">
                <input type="hidden" name="companyName" value="{{json_encode($companyName)}}">
                <input type="hidden" name="employmentAddress" value="{{json_encode($employmentAddress)}}">
                <input type="hidden" name="homeAddress" value="{{json_encode($homeAddress)}}">
                <input type="hidden" name="facebook" value="{{json_encode($facebook)}}">
                <input type="hidden" name="email" value="{{json_encode($email)}}">
                <input type="hidden" name="nameReference" value="{{json_encode($nameReference)}}">
                <input type="hidden" name="lastNameReference" value="{{json_encode($lastNameReference)}}">
                <input type="hidden" name="phoneReference" value="{{json_encode($phoneReference)}}">
                <input type="hidden" name="emailReference" value="{{json_encode($emailReference)}}">
                <input type="hidden" name="nameSecondReference" value="{{json_encode($nameSecondReference)}}">
                <input type="hidden" name="lastNameSecondReference" value="{{json_encode($lastNameSecondReference)}}">
                <input type="hidden" name="emailSecondReference" value="{{json_encode($emailSecondReference)}}">
                <input type="hidden" name="phoneSecondReference" value="{{json_encode($phoneSecondReference)}}">
                <input type="hidden" name="nameThirdReference" value="{{json_encode($nameThirdReference)}}">
                <input type="hidden" name="lastNameThirdReference" value="{{json_encode($lastNameThirdReference)}}">
                <input type="hidden" name="emailThirdReference" value="{{json_encode($emailThirdReference)}}">
                <input type="hidden" name="phoneThirdReference" value="{{json_encode($phoneThirdReference)}}">
                <input type="hidden" name="married" value="{{json_encode($isMarried)}}">
                <input type="hidden" name="rent" value="{{json_encode($rent)}}">

                <input type="submit" class="p-2 min-w-[60px] hover:cursor-pointer bg-purple-600 hover:bg-purple-700 rounded-md" value="si"
                  wire:click="toggleAlertCustomerInfo()" wire:submit.prevent="submit"
                >
              </form>
              <button wire:click="toggleAlertCustomerInfo()" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">no</button>
          </div>
      </div>
  </div>
</div>

