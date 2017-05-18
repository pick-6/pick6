@extends('layouts.master')
@section('content') 
<section class="charitiesPage">	
	<h1 class="text-center">All Charities</h1>
	<div class="container">
		<form class="navbar-form navbar-left" id="search" method="get" action="{{action('CharitiesController@index')}}">
			<div class="form-group">
				<input style="background-color: #333;color: #FEC503;font-family: 'Montserrat', sans-serif;" type="text" name="search" class="form-control" placeholder="Search Charity" required>
				<button style="background-color: #333;color: #FEC503;" type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
			</div>
		</form>
	</div>	
	<div class="container table-responsive">
		<table class="table table-bordered">
			<tr>
				<th>Name</th>
				<th>Website</th>
				<th>Description</th>
			</tr>
			@foreach ($charities as $charity)
				<tr>
					<td>{{ $charity->name }}</td>
					<td><a href="http://{{ $charity->website }}" target="_blank">{{ $charity->website }}</a></td>
					<td>{{ $charity->description }}</td>
				</tr>
			@endforeach
		</table>
		{!! $charities->render() !!}
	</div>
	<div class="text-center" style="background-color: black; color: white;font-size: 1.5em">
		"From what we get, we can make a living; what we give, however, makes a life." - Arthur Ashe
	</div>
</section>
@stop