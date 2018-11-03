<!-- Sign Up / Login Section -->
<div id="container" class="newSignLogin">
    <div id="buttons">
        <input type="button" class="button signup" value="Sign Up">
        <input type="button" class="button login active" value="Log In">
    </div>

    <form class="login-form" method="POST" action="{{action('Auth\AuthController@postLogin')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey">Welcome back!</h2>
        <input type="email" class="form-control" name="email" placeholder="Email Address *">
        <input type="password" class="form-control" name="password" placeholder="Password *">
        <div class="forgot-pass"><a href="{{action('Auth\PasswordController@postEmail')}}"><span class="forgot-link">Forgot Password?</span></a></div>
        <input type="submit" class="btn btn-lg" name="submit" value="Log in">
    </form>

    <form class="signup-form hide" method="POST" action="{{action('Auth\AuthController@postRegister')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey" style="line-height:40px;">Ready to Play? <br />Sign Up for Free!</h2>
        <input type="text" class="form-control first-name" name="first_name" placeholder="First Name *">
        <input type="text" class="form-control last-name" name="last_name" placeholder="Last Name *">
        <input type="text" class="form-control first-name" name="username" placeholder="Username *">
        <input type="email" class="form-control last-name" name="email" placeholder="Email Address *">
        <input type="password" class="form-control" name="password" placeholder="Create a Password *">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *">
        <input type="submit" class="btn btn-lg" name="submit" value="Get Started">
    </form>

    @if (count($errors) > 0)
        <div class="alert alert-danger" style="margin: 0;margin-top: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script type="text/javascript">
    $this = $('.newSignLogin');

    var signupForm = $this.find('.signup-form');
    var loginForm = $this.find('.login-form');
    var signupButton = $this.find('.signup');
    var loginButton = $this.find('.login');

    signupButton.on('click', function() {
        loginButton.removeClass('active');
        signupButton.addClass('active');
        signupForm.removeClass('hide');
        loginForm.addClass('hide');
        signupForm.find("input").first().focus();
    });

    loginButton.on('click', function() {
        signupButton.removeClass('active');
        loginButton.addClass('active');
        loginForm.removeClass('hide');
        signupForm.addClass('hide');
        loginForm.find("input").first().focus();
    });

    loginForm.on('submit', function(e){
        e.preventDefault();

        var e = loginForm.find("input[name=email]").val().trim();
        var p = loginForm.find("input[name=password]").val().trim();

        if (e == '' || p == '') {
            if (e == '' && p == '') {
                $(this).notify({
                    success: false,
                    text: "The email field is required.<br />The password field is required."
                });
                return false;
            }

            if (e == '') {
                $(this).notify({
                    success: false,
                    text: "The email field is required."
                });
                return false;
            }

            if (p == '') {
                $(this).notify({
                    success: false,
                    text: "The password field is required."
                });
                return false;
            }
        }

        $.ajax({
            url: "/login",
            type: "post",
            data: $(this).serialize(),
            error: function(data) {
                var text = "";
                var email = data.responseJSON.email;
                var password = data.responseJSON.password;
                if (email !== null && email !== undefined) {
                    text+=email;
                }
                if (password !== null && password !== undefined) {
                    if (email) {
                        text+="<br>";
                    }
                    text+=password;
                }
                $(this).notify({
                    success: false,
                    text: text
                });
            }
        }).done(function(data){
            if (data.success)
            {
                $(this).loadPage({
                    url: "/",
                    login: true,
                    message: data.msg
                });
            }
            else
            {
                $(this).notify({
                    success: data.success,
                    text: data.msg,
                });
            }
        });
    });

    signupForm.on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/register",
            data: $(this).serialize(),
            error: function(data){
                $(this).notify({
                    success: data.success,
                    text: data.msg
                });
            }
        }).done(function(data){
            $(this).notify({
                success: data.success,
                text: data.msg,
            });

            if (data.success) {
                $(this).loadPage({
                    url: "/",
                    isRegis: true,
                    message: data.msg
                });
            }
        });
    });

</script>
