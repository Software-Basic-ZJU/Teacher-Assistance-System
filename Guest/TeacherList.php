<!DOCTYPE html>
<!--<html lang="en">-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by 365Bootstrap dot com - Free Responsive Html5 Templates">

    <title>教师信息</title>

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
<body onload="Get_TeacherList()">
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
						<a class="page-scroll" href="#Teacher">教师信息</a>
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
		<!--教师信息-->
		<section id="Teacher" class="box-content box-1"  >
			<div class="container">

				<div class="row heading">
					<div class="col-lg-12">
						<h2>名师列表</h2>
						<hr>
					</div>
				</div>

				<div id="row" class="container-fluid">
<?php
	if(@$_COOKIE['teacher_num'])
		$num=$_COOKIE['teacher_num'];
	for($i=0; $i<$num; $i++)
	{
?>				
					<!--老师列表-->
					<div id="one-teacher" class="col-sm-3 box-item">
						<div class="wrap-img">
							<img id="<?php echo $i?>_photo" src="images/teacher/default.jpg" class="img-circle" style="height: 110px; width: 110px;">
						</div>
						<h3 id="<?php echo $i?>_name" class="blue"></h3>
						<p id="<?php echo $i?>_intro"></p>
						<div class="cd-see-all"><a href="#00<?php echo $i?>" class="btn btn-3">Detail</a></div>
						<br>
						<br>
					</div>			
	<?php
	}
?>
				</div>
			</div>
		</section>


		<!--老师详细信息-->
		<div class="cd-testimonials-all">
			<div class="cd-testimonials-all-wrapper">
		<?php
		for($i=0; $i<$num; $i++)
		{
		?>
				<!--带小点的表-->
				<section id="00<?php echo $i?>" class="tabsblock" style="padding-top: 200px;">
					<div class="wrap">
						<div class="tab">
							<!--教学经历	-->
							<div class="box visible">
								<div class="box-text">
									<h2>个人简介</h2>
									<hr>
									<br>
									<p id="<?php echo $i?>_teacherInfo">此处显示教师简介<?php echo $i?>.</p>
								</div>
							</div><!-- box -->
						</div><!-- tab -->
					</div><!-- wrap -->
				</section><!--  -->
		<?php
		}
		?>					
						
			</div>	<!-- cd-testimonials-all-wrapper -->
			<a href="" class="close-btn">close</a>
		</div> <!-- cd-testimonials-all -->




	<!--底-->
		<?php
			include "footer.php"
		?>
	<!-- Footer -->
	
	<script type="text/javascript">
    // PHP 后端交互所用到的
    function Get_TeacherList(){
        $.getJSON("./backend/TeacherInfo/TeacherInfo.php", function(json){
        	//alert("test");
      		num = json.res.length;
      		for(i=0; i<num; i++)
      		{
      			//获取教师列表介绍
		    	$("#" + i +"_name").html("");
	    		$("#" + i +"_intro").html("");
	 	        $("#" + i +"_name").append(json.res[i].name);
	        	$("#" + i +"_intro").append(json.res[i].brief_intro);
	        	//if(json.res[i].photo_path)
	        	//{
	        	//	$("#" + i +"_photo").html("");
	        	//	$("#" + i +"_photo").attr("src",json.res[i].photo_path);
	        	//}
				
				//获取教师详细介绍
				$("#" + i +"_teacherInfo").html("");
				$("#" + i +"_teacherInfo").append(json.res[i].teacher_info);
				//$("#" + i +"_teach-exp").html("");
                //$("#" + i +"_profile").html("");
                //$("#" + i +"_honor").html("");
                //$("#" + i +"_teach-exp").append(json.res[i].teach_experience);
                //$("#" + i +"_profile").append(json.res[i].profile);
				//$("#" + i +"_honor").append(json.res[i].honor);
      		}
      		
 		var date=new Date();
		var cookieExpire=date.getTime() + 3 * 30 * 24 * 60 * 60 * 1000 ;
		 
			/* 三个月 x 一个月当作 30 天 x 一天 24 小时 
			x 一小时 60 分 x 一分 60 秒 x 一秒 1000 毫秒 */
		//alert("now:"+date.getTime()+"/n now-1: "+cookieExpire);
		document.cookie="teacher_num="+num+" ;expires="+cookieExpire;
		//alert("222");
        });
       
}

	</script>
		
	<script src="js/Teacher.js"></script>

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