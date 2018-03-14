(function() {
    "use strict";

    $('body').fadeIn(500);

    setTimeout(function(){
        $(".createPostBtn").toggleClass("animated pulse");
        setInterval(function(){
            $(".createPostBtn").toggleClass("animated pulse");
        }, 3000);
    }, 1000);

    $('ul.dropdown-menu *').click(function(e){
        e.stopPropagation(); 
    });

    $('.closeDrop').click(function(){
        $('.userAccount').removeClass('open'); 
    });

    $('#changePhoto').click(function(){
        $('#chooseProfilePic').trigger('click'); 
    });
    
    $('#chooseProfilePic').on('click touchstart', function(){
        $(this).val('');
    });
    
    $("#chooseProfilePic").change(function(e) {
        $("#sumbitProfilePic").trigger('click');
    });

})();