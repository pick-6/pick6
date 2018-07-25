<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HEAD TAGS -->
    @include('partials.head')
</head>
<body>
    <!-- PAGE CONTENT -->
    <div class="welcome" style="min-height: 100vh">
        <div id="pageContent" style="min-height: 100vh">
            <section style="background: none;height: 100vh">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
</body>
</html>
