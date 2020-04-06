<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <!-- navbar -->
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse"
                data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="container-fluid">
                    <div class="row">

                        <!-- sidebar -->
                        @auth
                        <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                            <a href="{{ url('/') }}"
                                class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4 bottom-border">
                                {{ config('app.name', 'Laravel') }}
                            </a>

                            <div class="bottom-border pb-3">
                                <img src="{{ asset('images/default-avatar.png') }}" width="50"
                                    class="rounded-circle mr-3">
                                <a href="#" class="text-white">{{ auth()->user()->name }}</a>
                            </div>

                            <ul class="navbar-nav flex-column mt-4">

                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link text-white p-3 mb-2">
                                        <i class="fas fa-home text-light fa-lg mr-3"></i>
                                        Dashboard
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white p-3 sidebar-link"
                                        data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-users-cog  fa-lg mr-3"></i>
                                        Admin
                                    </a>
                                    <div class="dropdown-menu">
                                        @can('list-users')
                                        <a href="{{ route('users.index') }}" class="nav-link sidebar-link">
                                            <i class="fas fa-users fa-lg mr-3"></i>
                                            Users
                                        </a>
                                        @endcan

                                        @can('list-roles')
                                        <a href="{{ route('roles.index') }}" class="nav-link sidebar-link">
                                            <i class="fas fa-user-tag fa-lg mr-3"></i>
                                            Roles
                                        </a>
                                        @endcan

                                        @can('list-permissions')
                                        <a href="#" class="nav-link sidebar-link">
                                            <i class="fas fa-user-lock fa-lg mr-3"></i>
                                            Permissions
                                        </a>
                                        @endcan

                                        <div class="dropdown-divider"></div>

                                        <a href="#" class="nav-link sidebar-link">
                                            <i class="fas fa-wrench fa-lg mr-3"></i>
                                            Settings
                                        </a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        @endauth
                        <!-- end of sidebar -->

                        <!-- top-nav -->
                        <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h4 class="text-light text-uppercase mb-0">Dashboard</h4>
                                </div>
                                <div class="col-md-8">
                                    <ul class="navbar-nav">

                                        <!-- Authentication Links -->
                                        @guest
                                        <li class="nav-item">
                                            <a class="nav-link text-white"
                                                href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link text-white"
                                                href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                        @endif

                                        @else
                                        <li class="nav-item ml-md-auto dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ auth()->user()->name }}
                                                <span class="caret"></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="navbarDropdown">
                                                <ul>
                                                    <li class="dropdown-item">
                                                        Role {{ auth()->user()->roles->first()->name }}
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a class="nav-link" href="#" data-toggle="modal"
                                                            data-target="#sign-out">
                                                            <i class="fas fa-sign-out-alt text-danger fa-lg"></i>
                                                            Sign out
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end of top-nav -->
                    </div>
                </div>
            </div>
        </nav>
        <!-- end of navbar -->

        <!-- modal -->
        <div class="modal fade" id="sign-out">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Want to leave?</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        Press logout to leave
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Stay Here</button>

                        <a class="btn btn-danger" href="{{ route('logout') }}" data-dismiss="modal" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal -->

        <main class="container-fluid">
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 mt-md-5 ml-auto">
                    @yield('content')
                </div>
            </div>

        </main>
    </div>
</body>

</html>
