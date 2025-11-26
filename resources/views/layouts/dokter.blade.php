<!DOCTYPE html>
<html lang="en">
<head>@include('layouts.template.head')</head>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('layouts.template.sidebar-dokter') <main class="main-content position-relative border-radius-lg ">
        @include('layouts.template.navbar')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.template.footer')
        </div>
    </main>
    @include('layouts.template.scripts')
</body>
</html>