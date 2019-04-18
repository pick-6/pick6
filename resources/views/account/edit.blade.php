

<style type="text/css">
    section#contact.editAccount label {
        position: relative!important;
        top: 25px!important;
        font-size: 12px;
        left: 5px;
    }
    section#contact.editAccount .form-group input {
        padding: 20px 20px 5px 20px;
    }
    section#contact.editAccount #container {
        max-width: 800px;
        margin: 0 auto;
    }
    section#contact.editAccount .form-group {
        margin: 0;
    }
    @media (max-width: 990px) {
        section#contact.editAccount h2 {
            margin: 0 !important;
        }
        section#contact.editAccount {
            padding-top: 15px !important;
        }
    }
    @media(max-width:767px){
        section#contact.editAccount .section-heading {
            font-size: 30px;
        }
    }
</style>

<section id="contact" class="editAccount" style="background: none;padding: 0;padding-top: 40px;text-align: left;">
    <!-- <div id="container"> -->
        <div class="">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading margin-0">Edit Account</h2>
            </div>
        </div>
        <div class="col-lg-12">
            <form id="updateAccountForm" method="POST" action="{{action('AccountController@update')}}">
                {!! csrf_field() !!}
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name."> -->
                        <label class="fc-grey">First Name</label>
                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label class="fc-grey">Username</label>
                        <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fc-grey">Last Name</label>
                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label class="fc-grey">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <!-- <div class="clearfix"></div> -->
                <div class="col-lg-12" style="margin-top: 10px">
                    <div class="inline-block">
                        <a data-role-ajax="{{action('AccountController@editPassword')}}" class="btn btn-primary">change password</a>
                    </div>
                    <div class="pull-right inline-block">
                        <button type="submit" class="btn btn-success margin-right-10">UPDATE</button>
                        <a id="back" class="btn btn-danger">CANCEL</a>
                    </div>
                </div>
            </form>
        </div>
    <!-- </div> -->
</section>
<script type="text/javascript">
    $('#updateAccountForm').on('submit', function(e){
        e.preventDefault();

        $(this).postForm({
            url: "/account/update",
            reload: "/account"
        });
    });

    $('#back').on('click', function(){
        $(this).loadPage({url:'/account'});
    });
</script>
