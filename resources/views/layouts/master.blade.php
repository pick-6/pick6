<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HEAD TAGS -->
    @include('partials.head')
</head>
<style type="text/css">
    #pageContent {
        padding: 72px 20px 20px 20px;
        min-height: 100vh;
    }
    @media (max-width: 700px) {
        #pageContent {
            padding: 72px 10px 20px 10px;
        }
    }
</style>
<body>
    <!-- NAVBAR -->
    @include('partials.navbar')

    @if (Session::has('successMessage'))
            <div class="alert alert-success text-center" id="successMessage">{{ session('successMessage') }}</div>
    @endif

    <!-- PAGE CONTENT -->
    <div class="welcome" style="min-height: 100vh">
        <div id="pageContent">
            @yield('content')
        </div>
    </div>
    <!-- FOOTER -->
    @include('partials.footer')

    <!-- JS SCRIPTS -->
    @include('partials.common_js')

</body>
</html>
