<style>
    #accountPage .showAvatarContainer {
        background-image: url('/img/profilePics/{{$avatar}}');
    }
</style>

<div class="margin-0-auto showAvatarContainer smallGreyBorder">
    @if($isLoggedInUser)
        <form id="changeProfileImage" enctype="multipart/form-data" action="{{action('AccountController@uploadProfilePic')}}" method="POST">
            <input type="file" name="avatar" id="chooseProfilePic" class="hidden chooseProfilePic">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" id="submitProfilePic" class="hidden submitProfilePic">
        </form>
        <a id="changePhoto" class="changePhoto">
            <div class='showAvatarBG'>
                <p class="text-center fc-white" style="margin-top:60px;font-size:2rem;">
                    <i class="fas" style="font-size:6rem;"></i><br />
                    <small class="uppercase showAvatar"></small>
                </p>
            </div>
        </a>
    @endif
</div>

<script>
    // Upload Profile Pic from Account Page
    $('#accountPage').find('.changePhoto').click(function(){
        $('.chooseProfilePic').trigger('click');
    });

    $('#accountPage').find('.chooseProfilePic')
        .on('click touchstart', function(){
            $(this).val('');
        })
        .change(function(e) {
            $(".submitProfilePic").trigger('click');
        });

    // Change Profile Pic on Account Page
    $('#accountPage').find('.showAvatarContainer').on('mouseover mouseout', function(e){
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

    $('#changeProfileImage').on('submit', function(e){
        e.preventDefault();

        $(this).uploadFile({
            data: new FormData(this),
            url: "/upload",
            reload: "/account",
            data: new FormData(this),
            getAvatar: true
        });
    });
</script>
