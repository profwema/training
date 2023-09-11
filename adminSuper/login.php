
<?php
session_start();
require_once 'DBConnect.php';
$db = new DBConnect();
if(isset($_SESSION['logged-in']))
{
  header("Location:dashboard.php");
}


if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $Array = [];

	$error='';
    foreach ($_POST as $key => $value)
    {
        $Array[$key]= $db->legal_input($value);
    }

    $result = $db->login('usersystem',$Array);    
    if (is_array($result))
    {
		$db->goInsideAdmin($result[0]);


    }
    elseif($result)
    {
        $error .="بيانات تسجيل الدخول غير صحيحة";
    }
    else
    {
        $error .="Sorry but there is something error";
    }



}

?>




<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
	<title>TELC - لوحة التحكم</title>

		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="assets/fonts/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/main-responsive.css">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
		<link rel="stylesheet" href="assets/css/rtl-version.css">
		<link rel="stylesheet" href="assets/css/custom.css">
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login rtl">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo">
			<img src="assets/images/logo.jpg" alt="">	
		<h2>منصة التدريب للمركز الرئيسي للتدريب المستدام</h2>

			</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>الدخول الى حجرة التحكم</h3>

			      <!-- Error Message -->


				<form class="form-login" action="" method="POST">
						<?php
                                if(isset($error))
                                    {
                                    ?>
                                        <div class="errorHandler alert alert-danger">		
											<i class="icon fa fa-ban" aria-hidden="true"></i> 

                                            <?=$error?> 
                                        </div>
                                    <?php
                                    }
                            ?>
					<fieldset>
						<div class="form-group">
							<span class="input-icon input-icon-right">
								<input type="text" class="form-control error" name="username" placeholder="اسم الدخول">
								<i class="fa fa-user"></i> </span>
							<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
							<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
						</div>
						<div class="form-group">
							<span class="input-icon input-icon-right">
								<input type="password" class="form-control password" name="password" placeholder="كلمة السر">
								<i class="fa fa-lock"></i>
							 </span>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-bricky pull-left btn-block btn-flat">
								<i class="fa fa-arrow-circle-right"></i>دخول 
							</button>
						</div>

					</fieldset>
				</form>
			</div>




			<div class="copyright">
			جميع الحقوق محفوظة © مركز التعليم الإلكتروني - جامعة طنطا | 2021 
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<script src="assets/js/jquery.min.js"></script>

		<script src="assets/js/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/perfect-scrollbar-rtl.js"></script>
		<script src="assets/js/less-1.5.0.min.js"></script>

		<script src="assets/js/jquery.cookie.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/login.js"></script>


		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>


	<!-- end: BODY -->
</html>