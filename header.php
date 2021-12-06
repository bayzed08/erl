<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assist/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="assist/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="assist/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assist/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="custom/js/myjs.js"></script>



<link rel="stylesheet" href="custom/css/mystyle.css">

<script type="text/javascript">
	$(function(){
		$('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
		$('.nav a').click(function(){
			$(this).parent().addClass('active').siblings().removeClass('active')	
		})
	})
</script>
