(function() {
    "use strict";
    var freeCredit = true;

    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    function goToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'fast');
    };

    function closeModals() {
        $('.modal-backdrop, .modal').hide();
        $('body').removeClass('modal-open');
        $("#addCreditModal").find("article").removeClass("active blur selected");
    };

    $.fn.confirm = function(data) {
        var url = data.targetUrl,
            text = data.text,
            confirmBtnText = data.confirmText || "Yes",
            cancelBtnText = data.cancelText || "No";

        var confirmModal = $("<div>").addClass("confirm-modal"),
            confirmMessage = $("<div>").attr("id", "confirmMessage"),
            confirmContainer = $("<div>").addClass("confirm-container"),
            message = $("<div>").addClass("confirmText").text(text),
            btnContainer = $("<div>").addClass("confirm-btns"),
            confirmBtn = $("<div>").addClass("confirm").html($("<button>").addClass("btn btn-success").text(confirmBtnText)),
            cancelBtn = $("<div>").addClass("cancel").html($("<button>").addClass("btn btn-danger").text(cancelBtnText));

        btnContainer.append(confirmBtn).append(cancelBtn);
        confirmContainer.append(message).append(btnContainer);
        confirmMessage.append(confirmContainer);
        confirmModal.append(confirmMessage);

        $("body").append(confirmModal);

        $(this).getAnswer({ targetPage: url });
    }
    $.fn.getAnswer = function(data){
        $(".confirm-btns").find("button").on("click", function(){
            if ($(this).parent().hasClass("confirm")) {
                $(this).loadPage({ url: data.targetPage });
            }
            $(".confirm-modal").remove();
        });
    }

    $.fn.pageControl = function(links){
        links.on('click', function(){
            closeModals();

            var targetPage = $(this).data('role-ajax'),
                previousPage = $(".page-content").data("url"),
                isLogout = $(this).hasClass('logout'),
                forGameCancel = $(this).hasClass('forGameCancel'),
                hasPendingPicks = $('#gameTable').find('td.pendingPick').length,
                url = targetPage,
                // hasFadeFX = targetPage == previousPage ? false : true;
                hasFadeFX = true;

            if (hasPendingPicks) {
                $(this).confirm({
                    text: "Are you sure you want to leave this page? Your pending picks will not be saved.",
                    confirmText: "Yes, leave",
                    cancelText: "No, stay",
                    targetUrl: targetPage
                });
                return false;
            }

            $(this).loadPage({
                url: url,
                showLoading: false,
                logout: isLogout,
                gameCancel: forGameCancel,
                hasFadeFX: hasFadeFX,
                showBackBtn: targetPage != "/dashboard"
            });
        });
    }
    var links = $(document).find('[data-role-ajax]');
    $(document).pageControl(links);

    $.fn.postForm = function(data) {
        var url = data.url,
            reload = data.reload,
            addingCredit = data.addingCredit,
            makingPicks = data.makingPicks;

        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: $(this).serialize(),
            beforeSend: function(data){
                if (makingPicks) {
                    var pendingPicks = $("#gameTable").find(".pendingPick");
                    var icon = pendingPicks.find("i");
                    icon.removeClass();
                    icon.addClass("fas fa-spinner fa-pulse fc-yellow fs-20");
                }
            },
            success: function(data) {
                if (reload != null) {
                    $(this).loadPage({
                        url: reload,
                        hasFadeFX: false
                    });
                }
                $(this).loadCredit();
            },
            error: function(data) {
                if (reload != null) {
                    $(this).loadPage({
                        url: reload,
                        hasFadeFX: false
                    });
                }
            }
        }).done(function(data){
            closeModals();
            $(this).notify({
                success: data.success,
                text: data.msg,
                info: data.info
            });
        });
    };

    $.fn.notify = function(data) {
        var isSuccess = data.success,
            isInfo = data.info,
            type = isInfo ? "infoMessage" : isSuccess ? "successMessage" : "errorMessage",
            messageText = data.text || (isSuccess ? "Success!" : "Oops, something went wrong..."),
            messageDuration = data.duration || 4000,
            animateInCls = data.animateInCls || "bounceInRight fast",
            animateOutCls = data.animateOutCls || "bounceOutRight fast",
            maxWidth = data.maxWidth,
            message = $("<div>").addClass("alert animated").addClass(animateInCls).attr("id", type).html(messageText);

        if (maxWidth != null) {
            message.css("max-width", maxWidth + "px");
        }

        $("body").append(message);

        setTimeout(function(){
            message.removeClass(animateInCls).addClass(animateOutCls);
        }, messageDuration);

        setTimeout(function(){
            message.remove();
        }, messageDuration + 1000);
    };

    $.fn.loadPage = function(data) {
        var url = data.url,
            showLoading = data.showLoading,
            hasFadeFX = data.hasFadeFX,
            logout = data.logout,
            login = data.login,
            isRegis = data.isRegis,
            message = data.message,
            loadCredit = data.loadCredit,
            showBackBtn = data.showBackBtn || false,
            gameCancel = data.gameCancel;

        hasFadeFX = hasFadeFX != null ? hasFadeFX : true;

        $.ajax({
            url: url,
            async: true,
            beforeSend: function() {
                if (showLoading) {
                    $('#loading').show();
                }
                if (hasFadeFX && !gameCancel){
                    $(".page-content").hide();
                }
            },
            complete: function(){
                if (showLoading) {
                    $('#loading').hide();
                }
                if (hasFadeFX && !gameCancel){
                    $(".page-content").fadeIn(50);
                }
            },
            error: function(xhr, status, error) {
                $(this).notify({
                    success: false,
                    text: error
                });
            }
        }).done(function(data){
            if (logout || login || isRegis) {
                $('body').html(data);
                $(this).notify({
                    success: true,
                    text: logout ? "Logged out successfully!" : message
                });
            } else if(gameCancel) {
                $(this).notify({
                    success: data.success,
                    text: data.msg,
                    duration: data.duration,
                    maxWidth: data.maxWidth
                });
            } else {
                if (url != "/SignUpLoginView" && url != "/contact" ) {
                    $(this).loadCredit();
                }
                $('.page-content').html(data).data("url", url);
                if (showBackBtn) {
                    $('#back-btn').show();
                } else {
                    $('#back-btn').hide();
                }
                goToTop();
                var links = $('.page-content').find('[data-role-ajax]');
                $(this).pageControl(links);
            }
        });
    }

    $.fn.loadCredit = function(data) {
        closeModals();
        $.ajax({
            url: '/addCreditFromNav',
            async: true,
        }).done(function(data) {
            $('.addCreditFromNav').html(data);
        });
    }

    $.fn.loadProfileImage = function(data) {
        $.ajax({
            url: "/getProfilePic",
            async: true,
            success: function(data) {
                $('.dropdown.userAccount').html(data);
            }
        });
    }

    $.fn.uploadFile = function(data) {
        var url = data.url,
            reload = data.reload,
            getAvatar = data.getAvatar,
            data = data.data;

        $.ajax({
            url: url,
            data: data,
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            error: function(data){
                $(this).notify({
                    success: false,
                });
                $(this).loadPage({
                    url: reload
                });
            }
        }).done(function(data){
            $(this).notify({
                success: data.success,
                text: data.msg
            });
            if (reload != null) {
                $(this).loadPage({
                    url: reload,
                    hasFadeFX: false
                });
            }
            if (getAvatar != null) {
                $(this).loadProfileImage();
                $.holdReady( true );
                $.getScript( "/js/main.js", function() {
                    $.holdReady( false );
                });
            }
        });
    }

    $.fn.checkGamesCancelled = function(data) {
        var url = data.url,
            userId = data.userId;

        $.ajax({
            url: url + "/" + userId,
        }).done(function(data){
            if (!data.success) {
                $(this).notify({
                    success: data.success,
                    text: data.msg
                });
            }
        });
    }

    //////////////// For Free Charge ////////////////
    if (freeCredit) {
        var $addCredit = $("a.addCredit");
        $addCredit.on("click", function(){
            $("#payForm").find("input[name=amount]").remove();
            var amount = $(this).data("amount");
            var input = $("<input>").attr("type", "hidden").attr("name", "amount").attr("value", amount);
            var $form = $(this).closest("#payForm");
            $form.append(input).submit();
        });
        $("#payForm").on("submit", function(e){
            e.preventDefault();
            var url = $(".page-content").data("url");
            $(this).postForm({
                url: "/freecharge",
                addingCredit: true,
                reload: url
            });
        });
    }
    //////////////// End For Free Charge ////////////////

    //////////////// For Stripe Charge ////////////////
    if (!freeCredit) {
        $("a.addCredit").on("click", function(){
            var $amount = $(this).data("amount");
            addStripePaymentButton($amount);
        });
        $('#payForm').get(0).submit = function() {
            var url = $(".page-content").data("url");
            $(this).postForm({
                url: "/charge",
                addingCredit: true,
                reload: url
            });

            return false;
        }
    }
    //////////////// End For Stripe Charge ////////////////

    function addStripePaymentButton($amount){
        removeStripeScript();

        var $amountForStripe = $amount*100,
            $container = $("<div>").attr("id", "stripeBtnScript"),
            $stripeScript = $("<script>").addClass("stripe-button");

        $stripeScript.attr("src", "https://checkout.stripe.com/checkout.js");
        $stripeScript.attr("data-key", "pk_test_7AL8K2hvvfLEyVuLe6eLL1jE");
        $stripeScript.attr("data-amount", $amountForStripe);
        $stripeScript.attr("data-description", "Add $"+$amount+" of Credit");
        $stripeScript.attr("data-locale", "auto");
        $stripeScript.attr("data-email", "{{Auth::user()->email}}");
        $stripeScript.attr("data-zip-code", true);

        $container.append($stripeScript);
        $("#forStripe").append($container);

        var origin   = window.location.origin;
        var url = origin+"/charge";
        $("#payForm").attr("action", url);

        var $amountInput = $("<input>");
        $amountInput.attr("type", "hidden");
        $amountInput.attr("name", "amount");
        $amountInput.attr("value", $amountForStripe);
        $("#payForm").append($amountInput);

        setTimeout(function(){
            $("button.stripe-button-el").trigger("click");
        }, 500);
    }

    function removeStripeScript(){
        $("#forStripe").find("#stripeBtnScript").remove();
        $("#payForm").attr("action", "");
        $("#payForm").find("input[name=amount]").remove();
        $("iframe[name=stripe_checkout_app").remove();
    }

    $("button#closeAddCreditModal").on("click", function(){
        removeStripeScript();
        $(this).loadCredit();
    });


    // Change Profile Pic
    $('.accountDropdown').find('.showAvatarContainer').on('mouseover mouseout', function(e){
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

    // don't close Account Dropdown when clicking in it
    $('.accountDropdown').find('.showAvatarContainer').click(function(e){
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

    $('.profilePicForm').on('submit', function(e){
        e.preventDefault();
        var url = $(".page-content").data("url");
        $(this).uploadFile({
            url: "/upload",
            data: new FormData(this),
            reload: url,
            getAvatar: true
        });
    });

    // Flash Success message
    var duration = 4000;
    setTimeout(function(){
        $('.alert').addClass("animated bounceOutRight fast");
    }, duration);
    setTimeout(function(){
        $('.alert').remove();
    }, duration + 1000);


    // Clicking Account Dropdown
    $('[data-toggle="dropdown"]').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();

        var isExpanded = $(this).attr("aria-expanded");

        if (isExpanded == 'true') {
            $(this).attr("aria-expanded", false);
            $(this).parent().removeClass("open");
        } else {
            $(this).attr("aria-expanded", true);
            $(this).parent().addClass("open");
        }
    });

})();
