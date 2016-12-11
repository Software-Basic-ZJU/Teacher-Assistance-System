<!DOCTYPE html>
<!--<html lang="en">-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by 365Bootstrap dot com - Free Responsive Html5 Templates">

    <title>课程信息</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/animated-logo.min.css"><!-- Logo -->
	<link rel="stylesheet" href="css/our-team.css"> <!-- Resource style -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<link rel="stylesheet" href="css/style2.css">
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- Js -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="Get_Course()">
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
                        <a class="page-scroll" href="index.php">主页</a>
                    </li>
					<li>
						<a class="page-scroll" href="NewList.php">最新动态</a>
					</li>
					<li>
                        <a class="page-scroll" href="#page-content">课程信息</a>
                    </li>
					<li>
						<a class="page-scroll" href="TeacherList.php">教师信息</a>
					</li>
					<li>
						<a class="page-scroll" href="Resource.php">课件</a>
					</li>
					<li>
						<a class="page-scroll" href="MessageBoard.php">留言板</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	<!-- Navigation -->


	<!-- Main Part-->
	<div id="page-content" class="index-page">

		<!--课程信息-->
		<section class="tabsblock">
			<div class="wrap">
				<div class="tab">


					<!--国际国内背景	-->
					<div class="box visible">
						<div class="box-text">
							<h2>课程背景</h2>
							<hr>
							<br>
							<p  id='back_ground'>此处显示课程背景.</p>
						</div>
					</div><!-- box -->
					<div class="box">
						<div class="box-text">
							<h2>教学计划</h2>
							<hr>
							<br>
							<!-- <p id='courseplan'>此处显示教学计划</p> -->
						</div>
						<img id="img_address" src="" alt="此外应该是教学计划表">
					</div><!-- box -->
					<div class="box">
						<div class="box-text">
							<h2>教材&预修要求</h2>
							<hr>
							<br>
							<p id='text-pre'>此处显示教材&预修要求.</p>
						</div>
					</div><!-- box -->
					<div class="box">
						<div class="box-text">
							<h2>考核方式</h2>
							<hr>
							<br>
							<p id='exam'>此处显示考核方式.</p>
						</div>
					</div><!-- box -->
					<ul class="tabs clearfix">
						<li class="active"></li>
						<li></li>
						<li></li>
						<li></li>
					</ul><!-- tabs -->
				</div><!-- tab -->
			</div><!-- wrap -->
		</section><!--  -->



	<!--底-->
	<footer>
		<div class="wrap-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-footer footer-1">
						<div class="heading"><h4>About Us</h4></div>
						<div class="content">
							<p>关于我们的信息= = </p>
						</div>
					</div>
					<div class="col-md-6 col-footer footer-3">
						<div class="row">
							<div class="col-md-6">
								<a href="#"><img src="images/15.jpg" /></a>
							</div>
							<div class="col-md-6">
								<a href="#"><img src="images/16.jpg" /></a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="#"><img src="images/17.jpg" /></a>
							</div>
							<div class="col-md-6">
								<a href="#"><img src="images/18.jpg" /></a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="#"><img src="images/19.jpg" /></a>
							</div>
							<div class="col-md-6">
								<a href="#"><img src="images/20.jpg" /></a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<a href="#"><img src="images/21.jpg" /></a>
							</div>
							<div class="col-md-6">
								<a href="#"><img src="images/18.jpg" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<p>Copyright &copy; 2016. SRE G12 All rights reserved.<a href="http://www.baidu.com/">G12</a></p>
					</div>
					<div class="col-md-4">
						<ul class="list-inline">
							<li><a href="#"><i class="fa fa-twitter"></i></a>
							</li>
							<li><a href="#"><i class="fa fa-facebook"></i></a>
							</li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a>
							</li>
							<li><a href="#"><i class="fa fa-google"></i></a>
                            </li>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="list-inline">
							<li><a href="#">Privacy Policy</a>
							</li>
							<li><a href="#">Terms of Use</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer -->

	<script type="text/javascript">
    // PHP 后端交互所用到的
    function Get_Course(){
    	$("#back_ground").html("");
    	$("#courseplan").html("");
    	$("#text-pre").html("");
    	$("#exam").html("");
        $.getJSON("./backend/CourseInfo/CourseInfo.php", function(json){
        	$('#back_ground').append(json.res.background);
        	//$('#courseplan').append(json.res.course_plan);
        	var img_add = "./" + json.res.course_plan;
        	document.getElementById("img_address").src = img_add;
        	$('#text-pre').append(json.res.textbook_precourse);
        	$('#exam').append(json.res.exam_homework);
        });

    }
</script>

	
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