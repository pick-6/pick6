(function() {
    "use strict";

    // Flash Success message
    setTimeout(function(){
        $('#successMessage').fadeOut(1500);
    }, 2000);


    // changes background-color when hovering over available square
    $(".availableSquare").on('mouseout mouseover', function(e){
        var gradientStart = '';
        if (!$(this).hasClass('pendingPick')) {
            gradientStart = (e.type == 'mouseout') ? '#333' : '#111';
            $(this).css('background','linear-gradient(' + gradientStart + ', #222)');
        }
    });


    // don't close Account Dropdown when clicking in it
    $('ul.accountDropdown *').click(function(e){
        e.stopPropagation();
    });


    // Upload Profile Pic
    $('#changePhoto').click(function(){
        $('#chooseProfilePic').trigger('click');
    });

    $('#chooseProfilePic').on('click touchstart', function(){
        $(this).val('');
    });

    $("#chooseProfilePic").change(function(e) {
        $("#submitProfilePic").trigger('click');
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


    // hover effect on dashboard sections for desktop
    if ($(document).width() > 768) {
        $(".dashboardSection").on("mouseover", function(){
            $(this).css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)", "transition" : "opacity .2s ease-in"});
            $("body").css("overflow", "hidden");
        });
        $(".dashboardSection").on("mouseout", function(){
            $(this).css({"opacity":"0.80", "background-color":"rgba(0, 0, 0, 0.75)", "transition": "opacity .2s ease-out"});
            $("body").css("overflow", "auto");
        });
    } else {
        $(".dashboardSection").css({"opacity":"0.95", "background-color":"rgba(0, 0, 0, 1)"});
    }
})();
