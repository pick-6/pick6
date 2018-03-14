            <!-- Signup Modal -->
            <div id="signup" class="modal fade signupLoginModals" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="closeModal"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                        <div class="modal-header">
                            <h2 class="modal-title text-center">Ready to play? Get signed up!</h2>
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
                            <form  method="POST" action="{{action('Auth\AuthController@postRegister')}}">
                                {!! csrf_field() !!}
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls modalForm">
                                        <div class="col-xs-6 modalInput" style="padding-right: 5px">
                                            <input value="{{ old('first_name') }}" class="firstInput form-control form-group loginSignupPage" type="text" name="first_name" placeholder="First Name *">
                                        </div>
                                        <div class="col-xs-6 modalInput" style="padding-left: 5px">
                                            <input value="{{ old('last_name') }}" class="form-control form-group loginSignupPage" type="text" name="last_name" placeholder="Last Name *">
                                        </div>
                                        <div class="col-xs-6 modalInput" style="padding-right: 5px">
                                            <input value="{{ old('username') }}" class="form-control form-group loginSignupPage" type="text" name="username" placeholder="Username *">
                                        </div>
                                        <div class="col-xs-6 modalInput" style="padding-left: 5px">
                                            <input value="{{ old('email') }}" class="form-control form-group loginSignupPage" type="email" name="email" placeholder="Email *">
                                        </div>
                                        <div class="col-xs-6 modalInput" style="padding-right: 5px">
                                            <input class="form-control form-group loginSignupPage" type="password" name="password" placeholder="Create Password *">
                                        </div>
                                        <div class="col-xs-6 modalInput" style="padding-left: 5px">
                                            <input class="form-control form-group loginSignupPage" type="password" name="password_confirmation" placeholder="Confirm Password *">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="modalBtns"><button class="btn pull-left" type="submit">Create My Account</button></div>
                                    <div class="footerText">Already part of the team? <a href="#login" data-toggle="modal" data-dismiss="modal">Log In</a></div>
                                </div>
                            </form>
                        </div><!-- modal-body -->
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- signup modal -->


