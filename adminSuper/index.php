<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
?>

<?php
$section='home'; 
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->

<?php
	include('layout/head.php');
	?>

<!-- end: HEAD -->

<!-- start: BODY -->

<body class="rtl">

    <!-- start: HEADER -->
    <?php
		include('layout/header.php');
		?>
    <!-- end: HEADER -->

    <!-- start: MAIN CONTAINER -->
    <div class="main-container">

        <!-- start: NAVBAR -->
        <?php
				include('layout/navbar.php');
			?>
        <!-- evd: NAVBAR -->

        <!-- start: PAGE -->
        <div class="main-content">
            <div class="container">
                <!-- start: PAGE HEADER -->
                <div class="row">
                    <div class="col-sm-12">

                        <!-- start: PAGE TITLE & BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="#">
                                    الرئيسية
                                    <span class="selected"></span>
                                </a>
                            </li>

                        </ol>

                        <!-- end: PAGE TITLE & BREADCRUMB -->
                    </div>
                </div>
                <!-- end: PAGE HEADER -->
                <!-- start: PAGE CONTENT -->
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="core-box">
                            <!-- 								<div class="heading">
									<i class="clip-clip circle-icon circle-teal"></i>
									<h2>Manage Orders</h2>
								</div> -->
                            <div class="content">
                                <img src="assets/images/logo.jpg" alt="" style="width: 90%; margin: 20px 10%;">
                            </div>
                            <!-- 								<a class="view-more" href="#">
									View More <i class="clip-arrow-right-2"></i>

									<span class="selected"></span>				
								</a> -->
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <!-- end: PAGE CONTENT-->
            </div>
        </div>
        <!-- end: PAGE -->

    </div>
    <!-- end: MAIN CONTAINER -->

    <!-- start: LEFT SIDEBAR -->
    <?php
			include('layout/sidebar.php');		
		?>
    <!-- end: LEFT SIDEBAR -->


    <?php
			include('layout/footer.php');
		?>
</body>
<!-- end: BODY -->

</html>