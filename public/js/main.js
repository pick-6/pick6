(function() {
    "use strict";

    // Flash Success message
    setTimeout(function(){
        $('#successMessage').fadeOut(1500);
    }, 2000);


    // section scrolling
    $(".scroll a").bind("click",function(t){
        var l = $(this);
        $('html, body').find("section").stop().animate({
            scrollTop:$(l.attr("href")).offset().top-65
        },1500)
        t.preventDefault();
    });


    // changes background-color when hovering over available square
    $(".availableSquare").on('mouseout mouseover', function(e){
        var gradientStart = '';
        if (!$(this).hasClass('pendingPick')) {
            gradientStart = (e.type == 'mouseout') ? '#333' : '#111';
            $(this).css('background','linear-gradient(' + gradientStart + ', #222)');
        }
    });


    // don't close Account Dropdown when clicking in it
    $('ul.accountDropdown:not(.showAvatarContainer)').click(function(e){
        e.stopPropagation();
    });


    // Upload Profile Pic from Account Dropdown
    $('.accountDropdown').find('#changePhoto').click(function(){
        $('#chooseProfilePic').trigger('click');
    });

    $('.accountDropdown').find('#chooseProfilePic').on('click touchstart', function(){
        $(this).val('');
    });

    $('.accountDropdown').find("#chooseProfilePic").change(function(e) {
        $("#submitProfilePic").trigger('click');
    });


    // Upload Profile Pic from Account Page
    $('#accountPage').find('.changePhoto').click(function(){
        $('.chooseProfilePic').trigger('click');
    });

    $('#accountPage').find('.chooseProfilePic').on('click touchstart', function(){
        $(this).val('');
    });

    $('#accountPage').find(".chooseProfilePic").change(function(e) {
        $(".submitProfilePic").trigger('click');
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

    if ($(document).width() > 768) {
        $(".userCurrentGames").on("mouseover mouseout", function(e){
            if (e.type == 'mouseover') {
                $("body").css("overflow", "hidden");
            } else if (e.type == 'mouseout') {
                $("body").css("overflow", "auto");
            }
        });
    }


    // adding Credit
    $('.paymentBtns').find('.addCredit').on('click', function(e){
        $(this).siblings().find('button.stripe-button-el').trigger('click');
    });


    // Back to previous page
    $('#back').on('click', function() {
        window.history.back();
    });


    // Change Profile Pic on Account Page
    $('.showAvatarContainer').on('mouseover mouseout', function(e){
        if (e.type == 'mouseover')
        {
            $(this).find('.showAvatar').text('Change Photo');
            $(this).find('.showAvatar').parent().find('i').addClass('fa-camera');
            $(this)
            .css({
                'position': 'relative',
                'z-index': '1',
            });
            $(this).find('.showAvatarBG')
            .css({
                'position': 'absolute',
                'z-index': '-1',
                'background': '#000',
                'opacity': '.65',
                'width': '100%',
                'height': '100%'
            });
        }
        else
        {
            $(this).find('.showAvatar').text('');
            $(this).find('.showAvatar').parent().find('i').removeClass('fa-camera');
            $(this).find('.showAvatarBG')
            .css({
                'background': 'initial',
            });
        }
    });


    // Dashboard Dropdown
    $('.dashboard').find('.dashDrop').find('ul li.dropdown-item').on('click', function(){
        var title = $(this).text();
        var section = $(this).data('section');

        $('.dashboard').find('.dashboardSection').parent().removeClass('showOnTablet').addClass('hideOnTablet');
        $('.dashboard').find('.'+section+'').parent().removeClass('hideOnTablet').addClass('showOnTablet');
        $('.dashDrop').find('.dashDropBtn').find('.btnTitle').text(title);
    });
    $(window).resize(function() {
        if ($(document).width() > 991) {
            $('.dashboard').find('.dashboardSection').parent().removeClass('showOnTablet');
        }
    });
})();
