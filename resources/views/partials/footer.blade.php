<?php
    use Carbon\Carbon;
?>

<!-- Footer -->
<footer>
    <div class="container">
            <!-- <p class="footer-links">
                <a data-role-ajax="/about">About</a>

                <a data-role-ajax="/howtoplay">How To Play</a>

                <a data-role-ajax="/terms">Terms & Conditions</a>
            </p> -->
            <div class="col-md-12" style="padding: 0 !important;">
                <span class="copyright">Have Questions or Feedback? Please <a data-role-ajax="/contact" class="underline">Contact Us</a> </span>
            </div>
            <div class="col-md-12" style="padding: 0 !important;">
                <span class="copyright">Copyright &copy; Pick6 {{Carbon::now()->year}}</span>
            </div>
    </div>
</footer>
