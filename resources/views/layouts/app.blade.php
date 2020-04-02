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
</head>

<body>
    <div id="app">

        <!-- navbar -->
        <nav class="navbar navbar-expand-md navbar-light">
          <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="myNavbar">
            <div class="container-fluid">
              <div class="row">
                <!-- sidebar -->
                @auth
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                  <a href="#" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4 bottom-border">CodeAndCreate</a>
                  <div class="bottom-border pb-3">
                    <img src="{{ asset('images/admin.jpg') }}" width="50" class="rounded-circle mr-3">
                    <a href="#" class="text-white">Helen Smith</a>
                  </div>
                  <ul class="navbar-nav flex-column mt-4">

                    <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-home text-light fa-lg mr-3"></i>Dashboard</a></li>

                    @can('list-users')
                        <li class="nav-item  {{ Request::is('users*') ? 'active' : '' }}"><a href="{{ route('users.index') }}" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-user text-light fa-lg mr-3"></i>Users</a></li>
                    @endcan
                    @can('list-roles')
                        <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-envelope text-light fa-lg mr-3"></i>Roles</a></li>
                    @endcan
                    @can('list-permissions')
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-shopping-cart text-light fa-lg mr-3"></i>Permissions</a></li>
                    @endcan
                    <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-wrench text-light fa-lg mr-3"></i>Settings</a></li>
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
                    <div class="col-md-5">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
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
                            @can('list-roles')
                            <li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('roles.index') }}">
                                    <i class="fas fa-user-tag"></i>Roles
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->name }}
                                    <span class="badge badge-warning">{{ auth()->user()->roles->first()->name }}</span>
                                    <span class="caret"></span>
                                </a>
    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                    <div class="col-md-3">
                      <ul class="navbar-nav">
                        <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-comments text-muted fa-lg"></i></a></li>
                        <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-bell text-muted fa-lg"></i></a></li>
                        <li class="nav-item ml-md-auto"><a href="#" class="nav-link" data-toggle="modal" data-target="#sign-out"><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a></li>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Logout</button>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal -->
    
        <main class="py-4 container-fluid d-flex">



            @yield('content')

        </main>
    </div>
</body>

</html>
