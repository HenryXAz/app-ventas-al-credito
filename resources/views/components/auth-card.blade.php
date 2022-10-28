<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div>
        {{-- <a href="/"> --}}
            {{-- <x-application-logo class="w-20 h-20" /> --}}
        {{-- </a> --}}

        {{-- <h2 class="text-3xl text-purple-600 dark:text-purple-500">Iniciar Sesión</h2> --}}

        <a href="/">
          <img src="{{asset('images/logoBussiness.jpg')}}" alt="logo" width="200">
        </a>

    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>