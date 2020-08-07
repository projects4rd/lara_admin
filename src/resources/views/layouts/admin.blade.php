<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.admin.head')
</head>

<body>
    <div id="app">

        <div class="wrapper">

            @include('layouts.partials.admin.sidebar')

            @include('layouts.partials.admin.navbar')

            @include('layouts.partials.admin.logout-modal')

            <!-- Page Content  -->
            <div id="content">

                @include('shared.flash-message')

                @yield('content')
            </div>

        </div>

        @include('layouts.partials.admin.scripts')

        @stack('generic-script')
        @stack('sidebar-script')
        @stack('page-script')
</body>

</html>
