@extends('layouts.master')
@section('content')
<section class="howtoplay"> 
	<h1 class="text-center">How To Play</h1>
	
	<div class="container">
		<div class="col-sm-6 htpSteps">
			<h1 class="text-center">Step 1</h1>
			<div class="panel panel-primary">
				<div class="panel-heading text-center"></div>
				<div class="panel-body"><img src="/img/htp_table.png" class="img-responsive" id="itemsImages" alt="Image"></div>
				<div class="panel-footer">After selecting a football game to participate in, a 10x10 table will appear with the available and unavailable squares. The table is listed 0-9 going across and down the table.</div>
			</div>
		</div>
	
		<div class="col-sm-6 htpSteps">
			<h1 class="text-center">Step 2</h1>
			<div class="panel panel-primary">
				<div class="panel-heading text-center"></div>
				<div class="panel-body"><img src="/img/htp_select.png" class="img-responsive" id="itemsImages" alt="Image"></div>
				<div class="panel-footer">These numbers represent the last digit of each team's score at the end of the game. So if you believe Team 1 will finish with 3<span>5</span> points and Team 2 with 5<span>6</span> points, then you will select the square at column 5 and row 6.</div>
			</div>
		</div>
	
		<div class="col-sm-6 htpSteps" >
			<h1 class="text-center">Step 3</h1>
			<div class="panel panel-primary">
				<div class="panel-heading text-center"></div>
				<div class="panel-body"><img src="/img/htp_pick.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
				<div class="panel-footer">You will next be asked to confirm your square selection and to choose a donation amount. The default is set at $6 but you may select $10 or $20.</div>
			</div>
		</div>

		<div class="col-sm-6 htpSteps" >
			<h1 class="text-center">Step 4</h1>
			<div class="panel panel-primary">
				<div class="panel-heading text-center"></div>
				<div class="panel-body"><img src="/img/htp_won.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
				<div class="panel-footer">If your selection turns out to be the winning square, you will be notified and the game's total donation pot will be given to the charity of your choice.</div>
			</div>
		</div>

		<div class="text-center playBtn">
			<a @if (Auth::check()) href="/play" @else href="/register" @endif class="btn btn-xl getStartedBtn">Start Playing</a>			
		</div>
	</div>
	
</section> 
@stop