            <!-- Login Modal -->
            <div id="login" class="modal fade signupLoginModals" role="dialog">
                <div class="modal-dialog" style="width: 550px">
                    <div class="modal-content">
                        <div class="closeModal"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                        <div class="modal-header">
                            <h2 class="modal-title text-center">Log In To Start Playing!</h2>
                        </div>
                        <div class="modal-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form  method="POST" action="{{action('Auth\AuthController@postLogin')}}">
                                {!! csrf_field() !!}
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls modalForm">
                                        <div class="col-xs-12 modalInput">
                                            <input class="firstInput form-control form-group loginSignupPage" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                                        </div>
                                        <div class="col-xs-12 modalInput">
                                            <input class="form-control form-group loginSignupPage" type="password" name="password" placeholder="Password" value="{{old('password')}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <input type="checkbox" name="remember" class="loginSignupPage"> Remember Me
                                </div> -->
                                <div class="modal-footer">
                                    <div class="modalBtns"><button class="btn" type="submit">Log In</button></div>
                                    <div class="footerText">
                                        <div class="pull-left"><small><a style="text-decoration: underline;" href="#">Forgot Password?</a></small></div>
                                        <div class="pull-right">Not part of the team yet? <a href="#signup" data-toggle="modal" data-dismiss="modal">Create an Account</a></div>
                                    </div>
                                </div>
                            </form>
                        </div><!-- modal-body -->
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- login modal -->
