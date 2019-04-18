<!-- Sign Up / Login Section -->
<div id="container" class="newSignLogin">
    <div id="buttons">
        <input type="button" class="button signup" value="Sign Up">
        <input type="button" class="button login active" value="Log In">
    </div>

    <form class="login-form" method="POST" action="{{action('Auth\AuthController@postLogin')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey">Welcome back!</h2>
        <input data-required="true" type="email" class="form-control" name="email" placeholder="Email Address *">
        <input data-required="true" type="password" class="form-control" name="password" placeholder="Password *">
        <div class="forgot-pass"><a data-role-ajax="/password/email" id="forgot-link"><span class="forgot-link">Forgot Password?</span></a></div>
        <button type="submit" class="btn btn-lg width100" name="submit">Log In</button>
    </form>

    <form class="signup-form hide" method="POST" action="{{action('Auth\AuthController@postRegister')}}">
        {!! csrf_field() !!}
        <h2 class="message fc-grey" style="line-height:40px;">Ready to Play? <br />Sign Up for Free!</h2>
        <input data-required="true" type="text" class="form-control first-name" name="first_name" placeholder="First Name *">
        <input data-required="true" type="text" class="form-control last-name" name="last_name" placeholder="Last Name *">
        <input data-required="true" type="text" class="form-control first-name" name="username" placeholder="Username *">
        <input data-required="true" type="email" class="form-control last-name" name="email" placeholder="Email Address *">
        <input data-required="true" type="password" class="form-control" name="password" placeholder="Create a Password *">
        <input data-required="true" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *">
        <button type="submit" class="btn btn-lg width100" name="submit">Get Started</button>
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

        if ($(this).validateForm(this)) {
            $.ajax({
                url: "/login",
                type: "post",
                data: $(this).serialize(),
                beforeSend: function(){
                    $(".login-form").find("button[type=submit]").text("Processing").append("<i class='fas fa-spinner fa-pulse' style='margin-left:5px'></i>");
                },
                error: function(xhr, status, error) {
                    $(this).notify({
                        success: false,
                        text: error
                    });
                },
                complete: function() {
                    $(".login-form").find("button[type=submit]").text("Log In")
                }
            }).done(function(data){
                if (data.success)
                {
                    var userID = data.userId;

                    $(this).loadPage({
                        url: "/",
                        login: true,
                        message: data.msg
                    });

                    $(this).checkGamesCancelled({
                        url: "/checkGamesCancelled",
                        userId: userID
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
        }
    });

    signupForm.on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/register",
            data: $(this).serialize(),
            error: function(xhr, status, error) {
                $(this).notify({
                    success: false,
                    text: error
                });
            }
        }).done(function(data){

            $(this).notify({
                success: data.success,
                text: data.msg,
            });

            if (data.success)
            {
                $(this).loadPage({
                    url: "/",
                    isRegis: true,
                    message: data.msg
                });
            }
            else
            {
                $.each(data.fields, function(field){
                    var $this = signupForm.find("input[name="+field+"]");
                    $this.css("border-color", "crimson");
                    $this.on("change", function(){
                        checkIfEmpty($this, true);
                    });
                    function checkIfEmpty(field, showValidColor) {
                        var val = $(field).val().trim();

                        if (val === "") {
                            $(field).css({
                                "border-color": "crimson"
                            });
                            return true;
                        } else {
                            if (showValidColor) {
                                $(field).css({
                                    "border-color": "#2ecc71"
                                });
                            }
                            return false;
                        }
                    }
                });
            }
        });
    });

</script>
