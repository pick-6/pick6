<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Contact Form JavaScript -->
<script src="/js/jqBootstrapValidation.js"></script>
<script src="/js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="/js/agency.min.js"></script>

<!-- Square selection -->
<script type="text/javascript">
	$('td').mouseover(function(){
		$(this).css('background-color','#222');
	});

	$('td').mouseout(function(){
		$(this).css('background-color','#333');
	});

	$('#pickSquare').on('show.bs.modal', function(e) {
    	var hscore = $(e.relatedTarget).data('hscore');
    	var ascore = $(e.relatedTarget).data('ascore');
    	$("#hscore").val(hscore);
    	$("#ascore").val(ascore);
	});
</script> 