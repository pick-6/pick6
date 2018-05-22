<!-- Picking A Square Modal -->
<div id="pickSquare" class="modal fade pickSquareModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: linear-gradient(#222,#333);">
            <div class="closeModal" style="padding: 5px"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="modal-header">
                <h4 class="modal-title text-center" style="color: #FEC503">Confirming Your Square Selection</h4>
            </div>
            <div class="modal-body">
                <form  method="POST" action="{{ action('SelectionsController@store') }}">
                    {!! csrf_field() !!}
                        <input type=hidden name="user_id" value= "{{ Auth::user()->id }}">
                        <input type=hidden name="game_id" value="{{$thisGame[0]['id']}}">
                        <input type=hidden name="hscore" value="" class="hscore">
                        <input type=hidden name="ascore" value="" class="ascore">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls userPick">
                            <h4 class="text-center" style="color: #FEC503">Here Is Your Pick:</h4>
                            <p class="text-center" style="color: #eee">{{$thisGame[0]['home']}} final score at the end of the game will end with a <span class="hscore" style="margin-left: 5px"></span></p>
                            <p class="text-center" style="color: #eee">{{$thisGame[0]['away']}} final score at the end of the game will end with a <span class="ascore" style="margin-left: 5px"></span></p>
                            <div class="donation-container">
                                <h4 class="text-center" style="color: #FEC503">Choose Your Donation Amount:</h4>
                                <p class="text-center" style="color: #eee">(Your credit card won't be charged until you 'Go To Payment')</p>
                                <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                    <div class="info-block block-info clearfix">
                                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                            <label class="btn btn-default active" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                <div class="bizcontent">
                                                    <input type="radio" name="amount" autocomplete="off" value="6" checked>
                                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                    <h5>$6</h5>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                    <div class="info-block block-info clearfix">
                                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                            <label class="btn btn-default" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                <div class="bizcontent">
                                                    <input type="radio" name="amount" autocomplete="off" value="10">
                                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                    <h5>$10</h5>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="items col-xs-4 text-center" style="padding-right: 0px">
                                    <div class="info-block block-info clearfix">
                                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                            <label class="btn btn-default" style="border-color: initial;box-shadow:4px 4px 15px 0 #000">
                                                <div class="bizcontent">
                                                    <input type="radio" name="amount" autocomplete="off" value="20">
                                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                    <h5>$20</h5>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success pull-left" type="submit" style="background-color: #5cb85c;border-color: #4cae4c">Confirm Square</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-default btn-danger" style="color: #000;background-color: #d9534f;border-color: #d43f3a;">Cancel</button>
                    </div>
                </form>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
