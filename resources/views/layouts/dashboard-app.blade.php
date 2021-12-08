@include('partials/dashboard/dashboard-header')
@include('partials/dashboard/dashboard-side-menu')
@include('partials/dashboard/dashboard-navbar')

{{-- @yield('side-menu') --}}
@yield('content')

@include('partials/dashboard/dashboard-footer')