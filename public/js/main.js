(function() {
    "use strict";

    // Flash Success message
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


    // switch between signup / login
    const signupForm = $('.signup-form');
    const loginForm = $('.login-form');
    const signupButton = $('.signup');
    const loginButton= $('.login');

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


    // show section
    $(".showSection").on('click', function (){
        var section = "";

        // grab section to show
        switch (this.text) {
            case "About":
                section = ".showAbout"
                break;
            case "How To Play":
                section = ".howtoplay"
                break;
            case "Contact Us":
                section = ".showContact"
                break;
            case "Terms & Conditions":
                section = ".showTerms"
                break;
            case "Dashboard":
                section = ".dashboard"
                break;
            default:
                if ($("#pageContent section .container").children().hasClass("newSignLogin")) {
                    section = ".newSignLogin"
                } else if ($("#pageContent section .container").children().hasClass("dashboard")){
                    section = ".dashboard"
                } else {
                    return $(this).attr('href', '/dashboard');
                }
                break;
        }

        // show section (hide prev section)
        $(".activeSection").removeClass("activeSection");
        $(section).addClass("activeSection");

        // Go to top of page
        $('html,body').scrollTop(0);

        // focus on first input of contact form
        if ($(".showContact").hasClass("activeSection")) {
            $(".showContact").find("#contactForm").find("input").first().focus();
        }

        // Show first step of htp
        if ($(".howtoplay").hasClass("activeSection")) {
            $(".howtoplay").find("#howtoplay").find('.item.active').removeClass('active');
            $(".howtoplay").find("#howtoplay").find('.item').first().addClass('active');
        }
    });




    if ($(document).width() > 991) {
        $(".dashboardSection").on("mouseover", function(){
            $(this).css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)", "transition" : "opacity .2s ease-in"});
            $("body").css("overflow", "hidden");
        });
        $(".dashboardSection").on("mouseout", function(){
            $(this).css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)", "transition": "opacity .2s ease-out"});
            $("body").css("overflow", "auto");
        });
    } else {
        // $(".dashboardSection").css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)"});
        $(".dashboardSection").css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)"});
    }

})();
