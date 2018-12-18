<style>
    .ib-container{
        position: relative;
        width: 100%;
        margin: 0px auto;
    }

    .ib-container:before,
    .ib-container:after {
        content:"";
        display:table;
    }
    .ib-container:after {
        clear:both;
    }

    .ib-container article{
        width: calc(33% - 29px);
        overflow-y: auto;
        height: 110px;
        background: #111;
        cursor: pointer;
        float: left;
        border: 10px solid #111;
        text-align: left;
        text-transform: none;
        margin: 15px;
        z-index: 1;
        box-shadow:
            0px 0px 0px 10px #111,
            1px 1px 3px 10px rgba(125,125,125,0.2);
        transition:
            opacity 0.4s linear,
            transform 0.4s ease-in-out,
            box-shadow 0.4s ease-in-out;
      -webkit-backface-visibility: hidden
    }
    @media(max-width:450px){
        .ib-container article{
            width: calc(100% - 29px);
        }
    }
    .ib-container h3 a{
        font-size: 16pt;
      font-family:"Arial";
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
        text-shadow: 0px 0px 0px rgba(51, 51, 51, 1);
        opacity: 0.8;
    }
    .ib-container article header span{
        font-size: 10pt;
        font-family: Gill Sans, serif;
        padding: 10px 0;
        display: block;
        color:#ccc;
        text-shadow: 0px 0px 0px rgba(255, 210, 82, 1);
        text-transform: uppercase;
        opacity: 0.8;
    }
    .ib-container article p{
        font-family: Arial, sans-serif;
        font-size: 11pt;
        color: #5cb85c;
        /* color: --var(yellow); */
        text-shadow: 0px 0px 0px rgba(51, 51, 51, 1);
        opacity: 0.8;
    }

    ib-container h3 a,
    .ib-container article header span,
    .ib-container article p{
        transition:
            opacity 0.2s linear,
            text-shadow 0.5s ease-in-out,
            color 0.5s ease-in-out;
    }

    .ib-container article.blur{
        box-shadow: 0px 0px 20px 10px #111;
        transform: scale(0.9);
        opacity: 0.7;
    }


    .ib-container article.blur h3 a{
        text-shadow: 0px 0px 10px rgba(51, 51, 51, 0.9);
        color: rgba(0, 0, 0, 0);
        opacity: 0.5;
    }
    .ib-container article.blur header span{
        text-shadow: 0px 0px 10px rgba(255, 210, 82, 0.9);
        color: rgba(0, 0, 0, 0);
        opacity: 0.5;
    }
    .ib-container article.blur  p{
        text-shadow: 0px 0px 10px rgba(34, 79, 34, 0.9);
        color: rgba(51, 51, 51, 0);
        opacity: 0.5;
    }

    .ib-container article.active{
        transform: scale(1.05);
        box-shadow:
            0px 0px 0px 10px #111,
            1px 11px 15px 10px rgba(51,51,51,0.4);
        z-index: 100;
        opacity: 1;
    }

    .ib-container article.active h3 a,
    .ib-container article.active header span,
    .ib-container article.active p{
        opacity; 1;
    }

    section.ib-container{
        background-color: transparent!important;
    }
</style>

<section class="ib-container" id="ib-container">
    <a class="addCredit" data-amount="10">
        <article>
            <p style="font-size:50px;text-align:center">$10</p>
        </article>
    </a>
    <a class="addCredit" data-amount="20">
        <article>
            <p style="font-size:50px;text-align:center">$20</p>
        </article>
    </a>
    <a class="addCredit" data-amount="50">
        <article>
            <p style="font-size:50px;text-align:center">$50</p>
        </article>
    </a>
</section>

<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    var $container  = $('#ib-container'),
        $articles   = $container.find('article'),
        timeout;

    $articles.on( 'mouseenter', function( event ) {
        var $article    = $(this);
        clearTimeout( timeout );
        timeout = setTimeout( function() {

            if( $articles.hasClass('selected') ) return false;
            if( $article.hasClass('active')) return false;

            $articles.not($article).removeClass('active').addClass('blur');

            $article.removeClass('blur').addClass('active');

        }, 75 );
    });

    $container.on( 'mouseleave', function( event ) {
        clearTimeout( timeout );
        if( $articles.hasClass('selected') ) return false;
        $articles.removeClass('active blur');
    });

    $articles.on( 'click', function( event ) {
        if( $articles.hasClass('selected') ) return false;
        $articles.removeClass('selected')
        $(this).addClass("selected");
        console.log("yo");
    });
</script>
