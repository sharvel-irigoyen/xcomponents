<nav class="navbar navbar-expand-md border-bottom nav-color bg-black">

    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand me-4 ms-md-4" href="/">
            <x-application-mark />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <x-nav-link class="text-white" href="{{ route('store.index') }}" :active="request()->routeIs('store.index')" wire:navigate.hover>
                    Tienda
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav align-items-center me-md-4">
                @guest
                    <ul class="navbar-nav me-auto">
                        <x-nav-link class="text-white" href="{{ route('login') }}" :active="request()->routeIs('login')" wire:navigate.hover>
                            <i class="fa-solid fa-right-to-bracket me-1"></i> {{ __('Log in') }}
                        </x-nav-link>
                        <x-nav-link class="text-white" href="{{ route('register') }}" :active="request()->routeIs('register')" wire:navigate.hover>
                            <i class="fa-solid fa-user me-2"></i>{{ __('Register') }}
                        </x-nav-link>
                    </ul>
                @endguest

                <!-- Settings Dropdown -->
                @auth
                    <ul class="navbar-nav me-auto">
                        <x-nav-link class="text-white" href="{{ route('user-items') }}" :active="request()->routeIs('user-items')">
                            <i class="fa-solid fa-table-list me-1"></i>Mis productos
                        </x-nav-link>
                        <x-nav-link class="text-white" href="{{ route('user.shopping.cart') }}" :active="request()->routeIs('user.shopping.cart')">
                            <i class="fa-solid fa-cart-shopping me-2"></i>Carrito
                        </x-nav-link>
                    </ul>
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="rounded-circle" width="32" height="32"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                {{ Auth::user()->name }}

                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <h6 class="dropdown-header small text-muted">
                                {{ __('Manage Account') }}
                            </h6>

                            <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate.hover>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <hr class="dropdown-divider">

                            <!-- Authentication -->
                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

            </ul>
        </div>
    </div>
    </svg>
</nav>
