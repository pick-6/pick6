@extends('layouts.master')
@section('content') 
<section style="background-color: black">	
	<h1 class="text-center">Charities</h1>
	<div class="container">
		<table class="table table-bordered">
			<tr>
				<th>Name</th>
				<th>Wesbite</th>
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
</section>
@stop