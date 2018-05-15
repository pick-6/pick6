<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Contact Form JavaScript -->
<script src="/js/jqBootstrapValidation.js"></script>
<script src="/js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="/js/agency.min.js"></script>

<!-- Site JavaScript -->
<script type="text/javascript">
(function() {
    "use strict";

    setTimeout(function(){
        $('#successMessage').fadeOut(1500);
    }, 2000);

    // changes background-color when hovering over available square
    $('.availableSquare').mouseover(function(){
        $(this).css('background','linear-gradient(#111, #222)');
    });

    $('.availableSquare').mouseout(function(){
        $(this).css('background','linear-gradient(#333, #222)');
    });


    // to show separate scores on modal
    $('#pickSquare').on('show.bs.modal', function(e) {
        var hscore = $(e.relatedTarget).data('hscore');
        var ascore = $(e.relatedTarget).data('ascore');
        $(".hscore").val(hscore).text(hscore);
        $(".ascore").val(ascore).text(ascore);
    });


    // donation selected
    $('label.btn-default').click(function(){
        $('label.btn-default').removeClass('active');
        $(this).addClass('active');
    });
    $("#pickSquare").on('show.bs.modal', function () {
        $('label.btn-default').removeClass('active');
        $('label.btn-default').first().addClass('active');
    });


    // section scrolling
    $(".scroll a").bind("click",function(t){
        var l = $(this);
        $("html, body").stop().animate({
            scrollTop:$(l.attr("href")).offset().top-65
        },1500)
        t.preventDefault();
    });
    // animate arrow on welcome page for section scrolling
    setTimeout(function(){
        $("#charityArrow").toggleClass("animated bounce");
        setInterval(function(){
            $("#charityArrow").toggleClass("animated bounce");
        }, 5000);
    }, 10000);

    // focus on first input of login/signup modals
    $("#signup, #login").on('shown.bs.modal', function () {
        $(this).find(".firstInput").focus();
    });
    // focus on first input of contact form
    $("#contactForm").find("input").first().focus();


    // Account Dropdown Menu
    $('ul.dropdown-menu *').click(function(e){
        e.stopPropagation();
    });

    $('.closeDrop').click(function(){
        $('.userAccount').removeClass('open');
    });


    // Upload Profile Pic
    $('#changePhoto').click(function(){
        $('#chooseProfilePic').trigger('click');
    });

    $('#chooseProfilePic').on('click touchstart', function(){
        $(this).val('');
    });

    $("#chooseProfilePic").change(function(e) {
        $("#sumbitProfilePic").trigger('click');
    });


    // Show Step 1 everytime the 'How To Play' modal is opened
    $("#howtoplayModal").on('show.bs.modal', function () {
        $(this).find("#howtoplay").find('.item.active').removeClass('active');
        $(this).find("#howtoplay").find('.item').first().addClass('active');
    });

})();
</script>
