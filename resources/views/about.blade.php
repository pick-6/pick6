@extends('layouts.master')
@section('content')
<style type="text/css">
	@media (min-width:992px) {
		#aboutPage {
			width: 80%;
		}
	}
	@media (min-width:1100px) {
		#aboutPage {
			width: 70%;
		}
	}
	@media (min-width:1300px) {
		#aboutPage {
			width: 65%;
		}
	}
</style>

<!-- About Section -->
<div id="aboutPage" style="margin:0 auto">
	<h2 class="pageTitle" style="margin-bottom:60px;">About Pick6</h2>
	<p class="text-center">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
		dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
		sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
</div>
@stop
