<style>
    #howtoplayModal{
        transform: translateY(15%);
    }
    .carousel-control {
        background-image: linear-gradient(rgba(0,0,0,0) 100%,rgba(0,0,0,0) 100%)!important;
        height: 50px;
        margin: auto 0;
    }
    .carousel-control, .carousel-control:hover, .carousel-control:visited, .carousel-control:focus, .carousel-control:active {
        color: #fed136;
    }
    .carousel-control.right{
        right: -30px;
    }
    .carousel-control.left{
        left: -30px;
    }
    .panel-heading{
        color: #fff;
        padding-top: 10px!important;
    }
    .panel-body{
        padding-top: 5px!important;
    }
    .panel-footer{
        background-color: #222;
        color: #fff;
    }
</style>
    <!-- Login Modal -->
    <div id="howtoplayModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 650px;margin:0 auto;padding: 10px;">
            <div class="closeModal"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div id="howtoplay" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="panel" id="step1" style="background-color:#333">
                				<div class="panel-heading text-center" style="padding:0"><h3 style="margin:0">Step 1</h3></div>
                				<div class="panel-body"><img style="margin:0 auto" src="/img/htp_table.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
                				<div class="panel-footer">After selecting a football game to participate in, a 10x10 table will appear with the available and unavailable squares. The table is listed 0-9 going across and down the table.</div>
                			</div>
                        </div>

                        <div class="item">
                            <div class="panel" id="step2" style="background-color:#333">
                				<div class="panel-heading text-center" style="padding:0"><h3 style="margin:0">Step 2</h3></div>
                                <div class="panel-body"><img style="margin:0 auto" src="/img/htp_select.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
                				<div class="panel-footer">These numbers represent the last digit of each team's score at the end of the game. So if you believe Team 1 will finish with 3<span class="fc-yellow">5</span> points and Team 2 with 5<span class="fc-yellow">6</span> points, then you will select the square at column 5 and row 6.</div>
                			</div>
                        </div>

                        <div class="item">
                            <div class="panel" id="step3" style="background-color:#333">
                				<div class="panel-heading text-center" style="padding:0"><h3 style="margin:0">Step 3</h3></div>
                                <div class="panel-body"><img style="margin:0 auto" src="/img/htp_pick.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
                				<div class="panel-footer">You will next be asked to confirm your square selection and to choose a donation amount. The default is set at $6 but you may select $10 or $20.</div>
                			</div>
                        </div>

                        <div class="item">
                            <div class="panel" id="step4" style="background-color:#333">
                				<div class="panel-heading text-center" style="padding:0"><h3 style="margin:0">Step 4</h3></div>
                                <div class="panel-body"><img style="margin:0 auto" src="/img/htp_won.png" class="img-responsive htpImg" id="itemsImages" alt="Image"></div>
                				<div class="panel-footer">If your selection turns out to be the winning square, you will be notified and the game's total donation pot will be given to the charity of your choice.</div>
                			</div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#howtoplay" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#howtoplay" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
