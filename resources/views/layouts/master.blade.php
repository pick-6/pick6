<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HEAD TAGS -->
    @include('partials.head')
</head>
<style type="text/css">
    #pageContent {
        padding-top: 80px;
        min-height: 100vh;
    }
</style>
<body>
    <!-- NAVBAR -->
    @include('partials.navbar')

    @if (Session::has('successMessage'))
        <div class="alert alert-success text-center" id="successMessage">{{ session('successMessage') }}</div>
    @endif
    @if (Session::has('errorMessage'))
        <div class="alert alert-danger text-center" id="errorMessage">{{ session('errorMessage') }}</div>
    @endif

    <!-- PAGE CONTENT -->
    <div class="welcome" style="min-height: 100vh">
        <div id="pageContent">
            <!-- <div id="back-btn" class="absolute" style="left:25px;top:90px;display:none">
                <button class="btn back-btn" data-role-ajax="/dashboard"><i class="far fa-arrow-alt-circle-left"></i> Back</button>
            </div> -->
            <section style="background: none;padding: 0;padding-top: 40px;height: calc(100vh - 80px);overflow:auto;">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    @if(Auth::check())
        @include('payments.addCreditModal')
    @endif

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- JS SCRIPTS -->
    @include('partials.common_js')

    <!-- LOAD INITIAL PAGE CONTENT -->
    @if (Auth::check())
        <script>
            $(document).ready(function(){
                $(this).loadPage({
                    url: "/dashboard",
                    showLoading: true,
                    loadCredit: true,
                    showBackBtn: false
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function(){
                $(this).loadPage({
                    url: "/SignUpLoginView",
                    showLoading: true,
                    loadCredit: false
                });
            });
        </script>
    @endif

</body>
</html>
