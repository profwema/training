<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'groups';
$sesion = 'addGroup';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$p = basename($_SERVER['PHP_SELF']);
	$result = $db->addGroup($_POST);
	if ($result['status'])
		$db->success($result['msg'], $sesion, $p);
	else
		$db->wrong($result['msg'], $sesion, $p);
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
								<a href="groups.php">
									المجموعات الدراسية
									<span class="selected"></span>
								</a>
							</li>
							<li class="active">
								إضافة مجموعة دراسية جديدة

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
								إضافة مجموعة دراسية جديدة
							</div>
							<div class="panel-body">
								<?php
								if (isset($_SESSION[$sesion])) {
									echo $_SESSION[$sesion];
									unset($_SESSION[$sesion]);
								}
								?>
								<form action="" method="post" id='cat-form' class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label class="col-sm-2 control-label">
												اسم المجموعة الدراسية </label>
											<div class="col-sm-10">
												<input class="form-control" type="text" id="name" name="name" placeholder="الاسم المجموعة" value="" required="required" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"> تابعة لدورة</label>
											<div class="col-sm-10">
												<select name="course_id" class="form-control" required="required">
													<option> اختر الدورة </option>

													<?php
													$i = 0;
													$users = $db->getCourses();
													if (isset($users)) $i++;
													foreach ($users as $u) : $i++;
													?>
														<option value="<?= $u['id'] ?>"> <?= $u['name'] ?> </option>
													<?php endforeach; ?>

												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">المدرب المسند اليه التدريب</label>
											<div class="col-sm-10">
												<select name="inst_id" class="form-control" required="required">
													<option> اختر المدرب </option>

													<?php
													$i = 0;
													$users = $db->getInstractors();
													if (isset($users)) $i++;
													foreach ($users as $u) : $i++;
													?>
														<option value="<?= $u['id'] ?>"> <?= $u['name'] ?> </option>
													<?php endforeach; ?>

												</select>
											</div>
										</div>

										<div class="form-group">

											<label class="col-sm-2 control-label">
												السعة الدنيا
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="Min_No" name="Min_No" placeholder="أقل عدد لا يمكن للمجموعه ان تقل عنه" required="required" type="text" pattern="[0-9]+" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">
												السعة الفصوى
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="Max_No" name="Max_No" placeholder="العدد الأقصى المسموح به للانضمام للجروب" required="required" type="text" pattern="[0-9]+" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">
												تاريخ بداية الدورة
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="Start_date" name="Start_date" placeholder="اختار التاريخ" required="required" type="date" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">
												تاريخ نهاية الدورة
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="End_date" name="End_date" placeholder="اختار التاريخ" required="required" type="date" />
											</div>
										</div>
									</div>
									<div class="box-footer">
										<button class="btn btn-info pull-right" type="submit">إضافة</button>
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