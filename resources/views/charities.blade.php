@extends('layouts.master')
@section('content') 
<section class="charitiesPage"> 
    <h1 class="text-center">All Charities</h1>
    <div class="container">
        <form class="navbar-form navbar-left" id="search" method="get" action="{{action('CharitiesController@index')}}">
            <div class="form-group">
                <input style="background-color: #333;color: #FEC503;font-family: 'Montserrat', sans-serif;width: 80%;float: left;" type="text" name="search" class="form-control" placeholder="Search Charity" required>
                <button style="background-color: #333;color: #FEC503;" type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>  

    <div id="no-more-tables" class="container table-responsive"> 
        <table class="col-md-12 table-bordered table-condensed cf">
            <thead class="cf">
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($charities as $charity)
                <tr>
                    <td data-title="Name"><a class="charityName" href="http://{{ $charity->website }}" target="_blank">{{ $charity->name }}</a></td>
                    <td class="charitySite" data-title="Website"><a href="http://{{ $charity->website }}" target="_blank">{{ $charity->website }}</a></td>
                    <td data-title="Description">{{ $charity->description }}</td>
                </tr>
            @endforeach 
            </tbody>
        </table>
        {!! $charities->render() !!}    
    </div>
</section>
@stop