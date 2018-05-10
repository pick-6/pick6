<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HEAD TAGS -->
    @include('partials.head')
</head>
<body>
    <!-- NAVBAR -->
    @include('partials.navbar')

    @if (Session::has('successMessage'))
            <div class="alert alert-success text-center" id="successMessage">{{ session('successMessage') }}</div>
    @endif

    <!-- PAGE CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- JS SCRIPTS -->
    @include('partials.common_js')

</body>
</html>
