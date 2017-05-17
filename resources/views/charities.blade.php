@extends('layouts.master')
@section('content') 
<section class="charitiesPage">	
	<h1 class="text-center">All Charities</h1>
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