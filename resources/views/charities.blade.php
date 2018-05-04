@extends('layouts.master')
@section('content')
<?php
    $searching = isset($search) && !empty($search) && !ctype_space($search);
    $hasResults = $count > 0;
    $multiplePageResults = $count >= 40;
?>

<section class="charitiesPage">
    <h1 class="text-center fc-white">Charities</h1>
    <div class="container searchContainer">
        <form class="" id="search" method="get" action="{{action('CharitiesController@index')}}">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search for a Charity by Name, Type, or Keyword(s)" required>
                <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
    <div class="text-center">
        @if ($searching)
            @if ($hasResults)
                <h3 class="searchResults">Search Results For ("{{$search}}")</h3>
            @else
                <h3 class="searchResults">Sorry, No Results For ("{{$search}}")</h3>
            @endif
        @endif
    </div>
    <div id="no-more-tables" class="container table-responsive" style="max-height: calc(100% - <?= ($searching) ? '300px' : '225px' ?>)">
        @if ($hasResults)
        <table class="col-md-12 table-bordered table-condensed cf">
            <colgroup>
                <col style="width: 25%">
                <col style="width: 25%">
                <col style="width: 50%">
            </colgroup>
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
                    <td data-title="Name"><a class="charityName" href="https://{{ $charity->website }}" target="_blank">{{ $charity->name }}</a></td>
                    <td class="charitySite" data-title="Website"><a href="https://{{ $charity->website }}" target="_blank">{{ $charity->website }}</a></td>
                    <td data-title="Description">{{ $charity->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <div class="container">
        @if ($searching)
            <div id="backCharities">
                <a href="{{ action('CharitiesController@index') }}" class="btn btn-primary backCharitiesBtn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back to All Charities</a>
            </div>
        @endif
    </div>
    <div class="text-center">{!! $charities->render() !!}</div>
    <div class="paginationArrows prev">
        <a href="#" id="previousPage"><i class="fa fa-angle-left"></i></a>
    </div>
    <div class="paginationArrows next">
        <a href="#" id="nextPage"><i class="fa fa-angle-right"></i></a>
    </div>
</section>


<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $charitiesPage = $(".charitiesPage");

    // Go to Previous or Next Page
    $paginationArrows = $charitiesPage.find(".paginationArrows").children();
    $paginationArrows.click(function(){
        $Btn = $("ul.pagination").find("li a");
        if ($(this).parent().hasClass('prev')) {
           $movePage = $Btn.first();
        } else {
            $movePage = $Btn.last();
        }
        $page = $movePage.attr("href");
        window.location = $page;
    });

    // hide prev arrow if on first page
    $prev = $("ul.pagination").find("li").first();
    if ($prev.hasClass('disabled')) {
        $charitiesPage.find(".paginationArrows.prev").hide();
    }
    // hide next arrow if on last page
    $next = $("ul.pagination").find("li").last();
    if ($next.hasClass('disabled')) {
        $charitiesPage.find(".paginationArrows.next").hide();
    }
    // Hide arrows if no pagniation
    if (!$("ul.pagination").is(":visible")) {
        $charitiesPage.find(".paginationArrows").hide();
    };

    // toggle page overflow
    if ($(document).width() > 991) {
        $charitiesPage.find("table").bind("mouseenter mouseleave", function() {
            $("body").toggleClass("hideOverflow");
        });
    }

$(document).keyup(function(e) {
    switch (e.keyCode) {
        //Left Arrow
        case 37:
        $nextPage = $("ul.pagination").find("li a").first().attr('href');
        window.location = $nextPage;
        break;
        //Right Arrow
        case 39:
        $prevPage = $("ul.pagination").find("li a").last().attr('href');
        window.location = $prevPage;
        break;
    }
});
</script>
@stop
