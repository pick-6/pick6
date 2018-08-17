@extends('layouts.master')
@section('content')

<div class="playGamePage">
    <h3 class="fc-white text-center margin-top-0">Games for the Week</h3>
    @include('game.gamesForWeekList')
</div>

<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    if ($(document).width() > 991) {
        $(".playGamePage #no-more-tables").on("mouseover", function(){
            $("body").css("overflow", "hidden");
        });
        $(".playGamePage #no-more-tables").on("mouseout", function(){
            $("body").css("overflow", "auto");
        });
    }
</script>

@stop
