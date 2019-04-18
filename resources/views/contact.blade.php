
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
                            <input id="name" data-required="true" type="text" class="form-control" placeholder="Your Name *" name="name">
                        </div>
                        <div class="form-group">
                            <input id="email" data-required="true" type="email" class="form-control" placeholder="Your Email *" name="email">
                        </div>
                        <div class="form-group">
                            <input id="phone" type="tel" class="form-control" placeholder="Your Phone" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea id="message" data-required="true" class="form-control" placeholder="Your Message *" name="message"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-xl">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var $this = $("#contact"),
        $contactForm = $this.find("#contactForm");

    $contactForm.on('submit', function(e){
        e.preventDefault();
        var token = $(this).find("input[name=_token]").val().trim();
        var name = $(this).find("input#name").val().trim();
        var email = $(this).find("input#email").val().trim();
        var phone = $(this).find("input#phone").val().trim();
        var message = $(this).find("textarea#message").val().trim();
        var firstName = name; // For Success/Failure Message
        // Check for white space in name for Success/Fail message
        if (firstName.indexOf(' ') >= 0) {
            firstName = name.split(' ').slice(0, -1).join(' ');
        }

        if ($(this).validateForm(this)) {
            $.ajax({
                url: "/postContact",
                type: 'post',
                data: {
                    name: name,
                    firstName: firstName,
                    phone: phone,
                    email: email,
                    message: message,
                    _token: token
                },
                error: function(data){
                    $(this).notify({
                        success: false,
                    });
                }
            }).done(function(data){
                $(this).notify({
                    success: data.success,
                    text: data.msg
                });
                if (data.success) {
                    $contactForm.trigger("reset");
                }
            });
        }
    });
</script>
