<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section='admins'; 
$sesion= 'addCeUs';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$p = basename($_SERVER['PHP_SELF']);
	$result = $db->addUserCenter($_POST);
	if($result['status'])
		$db->success($result['msg'],$sesion,$p);
	else
		$db->wrong($result['msg'],$sesion,$p);
}		
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

<script type="text/javascript">   
    $(document).ready(function()
    {  
        $(".toggle-password").click(function() 
        {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") 
            {
                input.attr("type", "text");
            } 
            else 
            {
                input.attr("type", "password");
            }
        });          
    });
     
    </script>
	<body class="rtl">
		<?php
		include('layout/header.php');
		?>
		<div class="main-container">
			<?php
				include('layout/navbar.php');
			?>
			<div class="main-content">
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">

							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-home"></i>
									<a href="index.php">
										الرئيسية
										<span class="selected"></span>									
									</a>
								</li>
								<li>
									<a href="centerAdmins.php">
									مشرفي المراكز			
										<span class="selected"></span>									
									</a>
								</li>
								<li class="active">
									إضافة مشرف جديد	

								</li>

							</ol>

							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									إضافة مشرف جديد	
								</div>									
								<div class="panel-body">
									<?php
									if(isset($_SESSION[$sesion]))
									{
										echo $_SESSION[$sesion];
										unset($_SESSION[$sesion]);
									}
									?>
									<form action="" method="post"id='cat-form' class="form-horizontal">
										<div class="box-body">
											<div class="form-group">
												<label class="col-sm-2 control-label"> اسم المركز</label>
												<div class="col-sm-10">
													<select name="Center_fk" class="form-control">
														<option> اختر المركز </option>

																<?php
																$i=0;
																$users = $db->getCenters();
																if(isset($users)) $i++;
																foreach($users as $u): $i++;
																?>
																<option value="<?=$u['id']?>"> <?=$u['name']?> </option>
																<?php endforeach; ?>




															
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">اسم المستخدم</label>
												<div class="col-sm-10">
												<input  type="text" 
                                                            name="username" id ="user" 
															class="form-control"
                                                            pattern="[A-Za-z0-9_-]{1,15}"
                                                            title = "Only letters (either case), numbers, and the underscore; no more than 15 characters"
                                                            placeholder='تأكد من صلاحية الاسم' required>											
														
														</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">صورة التصنيف</label>
												<div class="col-sm-10">
												<input  type="password" 
                                                            name="password" id="pass"
															style="width: 90%;"   
															class="form-control"
                                                            placeholder = "حروف كبيره وصغيره وارقام وعلامات خاصة"
                                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" 
                                                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required
                                                            autocomplete="new-password" required>
                                                    <span toggle="#pass" title="اظهار الباسورد"
                                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>													
												</div>
											</div>

										</div>
										<div class="box-footer">
											<button class="btn btn-info pull-right" type="submit" >إضافة</button>
										</div>
									</form>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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