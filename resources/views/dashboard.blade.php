<x-app-layout>
    <!--  -->

  <div class="w-full flex justify-between">
    <h1 class="text-3xl font-light ">Bienvenido <span class="dark:text-purple-500 text-purple-700">{{Auth::user()->name}}</span></h1>
    <p>Tipo de usuario: 
      <span class="text-blue-500 text-2xl">
        @if(Auth::user()->role === "1")
          Administrador/a
        
        @endif

        @if(Auth::user()->role === "2")
          Vendedor/a
        @endif

        @if(Auth::user()->role === "3")
          Secretario/a
        @endif


      </span>
    </p>
  </div>

</x-app-layout>