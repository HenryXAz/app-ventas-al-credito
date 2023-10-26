<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Inicio" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
     
    </x-sidebar.link>

    @if(Auth::user()->role === "1")
    <x-sidebar.link title="Ingresos" href="{{ route('profits') }}" :isActive="request()->routeIs('profits')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1")
    <x-sidebar.link title="reporte clientes" href="{{ route('customerReports') }}" :isActive="request()->routeIs('customerReports')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1") 
    <x-sidebar.link title="Usuarios" href="{{ route('users') }}" :isActive="request()->routeIs('users')">
     
    </x-sidebar.link>
    @endif

    <x-sidebar.link title="Clientes" href="{{ route('customers') }}" :isActive="request()->routeIs('customers')">
     
    </x-sidebar.link>

    <x-sidebar.link title="Nuevo Credito" href="{{ route('newCredits') }}" :isActive="request()->routeIs('newCredits')">
     
    </x-sidebar.link>

    <x-sidebar.link title="Saldo Clientes" href="{{ route('showBalances') }}" :isActive="request()->routeIs('showBalances')">
     
    </x-sidebar.link>

</x-perfect-scrollbar>