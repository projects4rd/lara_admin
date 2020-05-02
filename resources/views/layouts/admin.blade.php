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

        <div class="wrapper">

            <!-- Sidebar  -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="sidebar-header">
                    <a href="#" class="navbar-brand d-block mx-auto text-center py-3 mb-4 bottom-border">
                        {{ config('app.name', 'Lara Admin') }}
                    </a>
                </div>

                <div class="bottom-border pb-3">
                    <img src="images/default-avatar.png" width="50" class="rounded-circle mr-3">
                    <a href="#" class="text-white">{{ auth()->user()->name }}</a>
                </div>

                <ul class="list-unstyled mt-4">

                    <li class="active">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home fa-lg mr-3"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="#adminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-users-cog fa-lg mr-3"></i>
                            Admin
                        </a>
                        <ul class="collapse list-unstyled" id="adminSubmenu">
                            @can('list-users')
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="fas fa-users fa-lg mr-3"></i>
                                    Users
                                </a>
                            </li>
                            @endcan

                            @can('list-roles')
                            <li>
                                <a href="{{ route('roles.index') }}">
                                    <i class="fas fa-user-tag fa-lg mr-3"></i>
                                    Roles
                                </a>
                            </li>
                            @endcan

                            @can('list-permissions')
                            <li>
                                <a href="#">
                                    <i class="fas fa-user-lock fa-lg mr-3"></i>
                                    Permissions
                                </a>
                            </li>
                            @endcan

                            <li>
                                <a href="#">
                                    <i class="fas fa-wrench fa-lg mr-3"></i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li>
                        <a class="nav-link download" href="#" data-toggle="modal" data-target="#sign-out">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                            Sign out
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Navbar  -->
            <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-collapse rounded-circle">
                        <i class="fas fa-align-left"></i>
                    </button>

                    <div class="ml-2">
                        <h4 class="text-uppercase mb-0">Dashboard</h4>
                    </div>

                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>



                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="#">Page</a>
                            </li>

                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif

                            @else
                            <li class="nav-item ml-md-auto dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->name }}
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <ul>
                                        <li class="dropdown-item">
                                            Role {{ auth()->user()->roles->first()->name }}
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link" href="#" data-toggle="modal" data-target="#sign-out">
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
            </nav>


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

            <!-- Page Content  -->
            <div id="content">
                @yield('content')
            </div>


        </div>

        @include('layouts.script')

        @yield('scripts')
</body>

</html>
