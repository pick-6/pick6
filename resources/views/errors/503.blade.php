@extends('layouts.error-master')

@section('content')
	<div class="content text-center fc-20" style="margin-top:100px;">
        <h2 class="fc-yellow">Sorry, we're under maintenance.</h2>
		<h2 class="fc-grey">Please try again later.</h2>
        <div style="margin-top:25px;">
            <a class="btn btn-primary fc-black" href="/">
                <h5>
                    <i class="fas fa-sync"></i> Refresh
                </h5>
            </a>
        </div>
	</div>
@stop
