<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'JMC') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (!empty(Auth::user()->id))
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Usuarios
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('user.index') }}"><i class="fa fa-fw fa-eye"></i> Usuarios</a>
                                <a class="dropdown-item " href="{{ route('rol.index') }}"><i class="fa fa-fw fa-eye"></i> Roles</a>
                                <a class="dropdown-item " href="{{ route('document_type.index') }}"><i class="fa fa-fw fa-eye"></i> Tipo de documento</a>
                            </div>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>
                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Equipos
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('equipment.index') }}"><i class="fa fa-fw fa-eye"></i> Equipos</a>
                                <a class="dropdown-item " href="{{ route('category_equipment.index') }}"><i class="fa fa-fw fa-eye"></i> Categoría de equipos</a>
                                <a class="dropdown-item " href="{{ route('find_equipaments') }}"><i class="fa fa-fw fa-eye"></i>Disponibilidad</a>
                                <a class="dropdown-item " href="{{ route('loan_detail.index') }}"><i class="fa fa-fw fa-eye"></i>Prestamos</a>
                            </div>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Equipos
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('find_equipaments') }}"><i class="fa fa-fw fa-eye"></i>Disponibilidad</a>
                            </div>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>
                        @endif
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sessión') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li> -->
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('user.show',auth()->user()->uuid) }}"><i class="fa fa-fw fa-eye"></i> Perfil</a>
                                <a class="dropdown-item " href="{{ route('update_password') }}"><i class="fa fa-fw fa-eye"></i> Cambiar contraseña</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sessión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>