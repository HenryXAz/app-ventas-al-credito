<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    {{-- <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link> --}}

    <x-sidebar.link title="Inicio" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
     
    </x-sidebar.link>

    @if(Auth::user()->role === "1")
    <x-sidebar.link title="Ingresos" href="{{ route('profits') }}" :isActive="request()->routeIs('profits')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1" || Auth::user()->role === "3")
    <x-sidebar.link title="reporte clientes" href="{{ route('customerReports') }}" :isActive="request()->routeIs('customerReports')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1") 
    <x-sidebar.link title="Usuarios" href="{{ route('users') }}" :isActive="request()->routeIs('users')">
     
    </x-sidebar.link>
    @endif

    
    @if(Auth::user()->role === "1" || Auth::user()->role === "2")
    <x-sidebar.link title="Clientes" href="{{ route('customers') }}" :isActive="request()->routeIs('customers')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1" || Auth::user()->role === "2")
    <x-sidebar.link title="Nuevo Credito" href="{{ route('newCredits') }}" :isActive="request()->routeIs('newCredits')">
     
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role === "1" || Auth::user()->role === "3")
    <x-sidebar.link title="Saldo Clientes" href="{{ route('showBalances') }}" :isActive="request()->routeIs('showBalances')">
     
    </x-sidebar.link>

    @endif

    {{-- Examples --}}

    {{-- <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')" /> --}}
        
    {{-- <x-sidebar.dropdown title="Buttons" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Text button" href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink title="Icon button" href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink title="Text with icon" href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown> --}}
       
</x-perfect-scrollbar>