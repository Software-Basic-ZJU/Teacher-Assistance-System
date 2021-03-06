<!DOCTYPE html>
<!--<html lang="en">-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by 365Bootstrap dot com - Free Responsive Html5 Templates">

    <title>留言板</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/animated-logo.min.css"><!-- Logo -->
	<link rel="stylesheet" href="css/our-team.css"> <!-- Resource style -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="css/creative.css">
	<link rel="stylesheet" href="css/creative.min.css">
	
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/messageboard.css">

	<!-- Js -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<!-- /////////////////////////////////////////Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar">t1</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">ZJU</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top">t2</a>
                    </li>
					<li>
                        <a class="page-scroll" href="../index.php">主页</a>
                    </li>
					<li>
						<a class="page-scroll" href="NewList.php">最新动态</a>
					</li>
					<li>
                        <a class="page-scroll" href="Classes.php">课程信息</a>
                    </li>
					<li>
						<a class="page-scroll" href="TeacherList.php">教师信息</a>
					</li>
					<li>
						<a class="page-scroll" href="Resource.php">课件</a>
					</li>
					<li>
						<a class="page-scroll" href="#messageboard">留言板</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	<div id="messageboard" class="fh5co-portfolio-section">
		<div  class="container" style="margin-top:10px">
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4">
					<div class="text-center">
						<h2 class="row heading">留言板</h2>
						<hr style="margin-bottom: 70px">
					</div>
				</div>
			</div>
			<?php
			include dirname(__FILE__).'/backend/MessageBoard/Get.php';
			?>
		</div>
	</div>


	<!--留言框-->
	<section class="box-content box-5" id="contact">
		<div class="container">
			<div class="row heading">
				<div class="col-lg-12" >
					<h2 style="font-size: 26px;">我要留言</h2>
					<hr>
				</div>
			</div>
			<div class="row" style="">
				<div class="col-md" >
					<div id="contact-form" >
						<form name="form1" method="post" action="./backend/MessageBoard/Send.php" style="margin: 0px auto">
<?php
$ip=$_SERVER["REMOTE_ADDR"];
$author = "游客(".$ip.")";

date_default_timezone_set("Asia/Shanghai");
$time = date("Y-m-d H:i:s"); 
?>
				<input type="hidden" name="author" value="<?php echo $author?>">
				<input type="hidden" name="time" value="<?php echo $time?>">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
											<textarea name="message" id="message" class="form-control" rows="4" cols="25"></textarea>
									</div>
									<button type="submit" class="btn btn-3 btn-block" name="btnContactUs" id="btnContactUs">
										提交</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	<!--底-->
		<?php
			include "footer.php"
		?>
	<!-- Footer -->

	
	<!-- jQuery -->
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="js/agency.js"></script>

	<!-- Animated Top -->
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/cbpAnimatedHeader.js"></script>
<!--疯狂套模板-->
	<script src="js/library.js"></script>
	<script src="js/retina.js"></script>
	<script src="js/sliders.js"></script>
	<script src="js/html5.js"></script>

    <!--最新动态的模板-->
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>


</body>
</html>