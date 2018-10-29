<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top margin-bottom-0">
    <div class="container">
        @include('partials.navbar.navHeader')

        @if (Auth::check())
            <div class="addCreditFromNav"></div>
        @endif

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    @include('partials.navbar.authNav')
                @else
                    @include('partials.navbar.nonAuthNav')
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="text-center" id="loading" style="display:none">Loading...</div>
