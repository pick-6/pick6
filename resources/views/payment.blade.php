@extends('layouts.master')
@section('content')
<section>
	<div class="container">
		<h1 class="text-center" style="color: white;">Payment Page</h1>

		<h2 class="text-center" style="color: white;">Your Picks</h2>
		    <table class="table table-bordered">
                <tr>
                    <th>Game</th>
                    <th>Selection</th>
                    <th>Donation Amount</th>
                </tr>
                @foreach ($gamesUserIsPlaying as $userSelection)
                <tr>
                    <td>{{$userSelection->game_id}}</td>
                    <td>{{$userSelection->square_selection}}</td>
                    <td>${{$userSelection->amount}}</td>
                </tr>
                @endforeach
            </table>

            <div class="container">
              <form class="form-horizontal" role="form">
                <fieldset>
                  <legend style="color: white;">Card Information</legend>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="card-holder-name" style="color: white;">Name on Card</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="card-number" style="color: white;">Card Number</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="expiry-month" style="color: white;">Expiration Date</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-xs-3">
                          <select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
                            <option>Month</option>
                            <option value="01">Jan (01)</option>
                            <option value="02">Feb (02)</option>
                            <option value="03">Mar (03)</option>
                            <option value="04">Apr (04)</option>
                            <option value="05">May (05)</option>
                            <option value="06">June (06)</option>
                            <option value="07">July (07)</option>
                            <option value="08">Aug (08)</option>
                            <option value="09">Sep (09)</option>
                            <option value="10">Oct (10)</option>
                            <option value="11">Nov (11)</option>
                            <option value="12">Dec (12)</option>
                          </select>
                        </div>
                        <div class="col-xs-3">
                          <select class="form-control" name="expiry-year">
                            <option value="13">2013</option>
                            <option value="14">2014</option>
                            <option value="15">2015</option>
                            <option value="16">2016</option>
                            <option value="17">2017</option>
                            <option value="18">2018</option>
                            <option value="19">2019</option>
                            <option value="20">2020</option>
                            <option value="21">2021</option>
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="cvv" style="color: white;">Card CVV</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
                    </div>
                  </div>
                  <div class="text-center">
                    <label style="color: white;">
                        <input type="checkbox">Remember this card 
                    </label> 
                  </div> <br>
                </fieldset>
              </form>
            </div>        
		<div class="text-center">
        	<a href="{{action('AccountController@index')}}" class="btn btn-xl dropdown-toggle gameBtn" type="button">Submit Payment</a>
		</div>
	</div>
</section>
@stop