<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>app ventas al crédito</title>

        <!-- Fonts -->
        <link
            rel="stylesheet" 
            href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        />

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('build/assets/app.7f022113.css ') }}">
        <script src="{{ asset('build/assets/app.5b2bdc69.js ') }}" defer></script>
    </head>
    <body class="antialiased font-sans bg-gray-100 text-gray-900 dark:bg-dark-eval-0 dark:text-gray-200">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm dark:text-gray-400 p-4 bg-blue-700 text-white rounded-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" 
                          class="text-sm  dark:text-gray-400 text-white bg-blue-700 p-4 rounded-md hover:bg-blue-600">Iniciar Sesión</a>
{{-- 
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-400 underline">Registrarse</a>
                        @endif --}}
                    @endauth
                </div>
            @endif

            <div class="w-3/4 text-center mx-auto sm:px-6 lg:px-8  p-4  dark:text-gray-300 text-gray-700">
              <h1 class="text-3xl"><span class="text-red-500">App </span> Préstamos Vehículos</h1>

            </div>

           

        </div>
        <footer class="w-full mx-auto bg-white p-4 flex flex-col">
          <p class="text-center">
            credo por estudiantes de ingeniería en sistemas <span class="text-indigo-500">UMG </span
          </p>
          
          <h6 class="text-gray-700 text-center">Quetzaltenango, Guatemala 2022</h6>              
        </footer>
    </body>
</html>
