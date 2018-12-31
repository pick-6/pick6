<section id="payment-options">
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
    <div id="forStripe" style="display: none"></div>
</section>


<script src="/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    var $container  = $('#payment-options'),
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

    // $articles.on( 'click', function( event ) {
    //     if( $articles.hasClass('selected') ) return false;
    //     $articles.removeClass('selected')
    //     $(this).addClass("selected");
    // });
</script>
