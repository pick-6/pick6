<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HEAD TAGS -->
    @include('partials.head')
</head>
<style type="text/css">
    #pageContent {
        padding-top: 72px;
        min-height: 100vh;
    }
    /* #pageContent {
        padding: 72px 20px 20px 20px;
        min-height: 100vh;
    }
    @media (max-width: 700px) {
        #pageContent {
            padding: 72px 10px 20px 10px;
        }
    } */
</style>
<body>
    <!-- NAVBAR -->
    @include('partials.navbar')

    @if (Session::has('successMessage'))
    <div class="alert alert-success text-center" id="successMessage">{{ session('successMessage') }}</div>
    @endif
    @if (Session::has('errorMessage'))
    <div class="alert alert-danger text-center" id="successMessage">{{ session('errorMessage') }}</div>
    @endif

    <!-- PAGE CONTENT -->
    <div class="welcome" style="min-height: 100vh">
        <div id="pageContent">
            <section style="background: none;padding: 0;padding-top: 40px;height: calc(100vh - 72px);overflow:auto">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- JS SCRIPTS -->
    @include('partials.common_js')

</body>
</html>
