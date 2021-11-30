@include('partials/dashboard-header')
@include('partials/dashboard-side-menu')
@include('partials/dashboard-navbar')

{{-- @yield('side-menu') --}}
@yield('content')

@include('partials/dashboard-footer')