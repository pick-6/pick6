
<!-- Contact Section -->
<div id="contact">
    <div class="">
        <div class="col-lg-12 text-center">
            <h2 class="pageTitle">Contact Us</h2>
            <h3 class="section-subheading fc-grey margin-bottom-15">Please leave any questions or feedback you may have.</h3>
        </div>
    </div>
    <div class="">
        <div class="col-lg-12">
            <form name="sentMessage" id="contactForm" novalidate>
                {!! csrf_field() !!}
                <div class="">
                    <div class="col-md-6 padding-b-0">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" placeholder="Your Phone" id="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <div id="success"></div>
                        <button type="submit" class="btn btn-xl">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#contactForm").on('submit', function(e){
        e.preventDefault();
        var token = $("input[name=_token]").val().trim();
        var name = $("input#name").val().trim();
        var email = $("input#email").val().trim();
        var phone = $("input#phone").val().trim();
        var message = $("textarea#message").val().trim();
        var firstName = name; // For Success/Failure Message
        // Check for white space in name for Success/Fail message
        if (firstName.indexOf(' ') >= 0) {
            firstName = name.split(' ').slice(0, -1).join(' ');
        }

        if (name == '' || email == '' || message == '') {
            if (name == '' && email == '' && message == '') {
                $(this).notify({
                    success: false,
                    text: "The name field is required.<br />The email field is required.<br />The message field is required."
                });
                return false;
            }

            if (name == '' && email == '') {
                $(this).notify({
                    success: false,
                    text: "The name field is required.<br />The email field is required."
                });
                return false;
            }

            if (name == '' && message == '') {
                $(this).notify({
                    success: false,
                    text: "The name field is required.<br />The message field is required."
                });
                return false;
            }

            if (email == '' && message == '') {
                $(this).notify({
                    success: false,
                    text: "The email field is required.<br />The message field is required."
                });
                return false;
            }

            if (name == '') {
                $(this).notify({
                    success: false,
                    text: "The name field is required."
                });
                return false;
            }

            if (email == '') {
                $(this).notify({
                    success: false,
                    text: "The email field is required."
                });
                return false;
            }

            if (message == '') {
                $(this).notify({
                    success: false,
                    text: "The message field is required."
                });
                return false;
            }
        }


        $.ajax({
            url: "/postContact",
            type: 'post',
            data: {
                name: name,
                phone: phone,
                email: email,
                message: message,
                _token: token
            },
            error: function(data){

            }
        }).done(function(data){
            $(this).notify({
                success: data.success,
                text: data.msg
            });
            if (data.success) {
                $('#contactForm').trigger("reset");
            }
        });
    });
</script>
