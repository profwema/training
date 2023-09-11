<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'courses';
$sesion = 'editCourse';

if (isset($_GET['edit'])) {
	$data['id'] = $_GET['edit'];
	$result = $db->getCourses($data);
	$user = $result[0];
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo $data['id'];
	$p = basename($_SERVER['PHP_SELF']);
	if (isset($_SERVER["QUERY_STRING"])); {
		$p = $p . '?' . $_SERVER["QUERY_STRING"];
	}
	$result = $db->editCourses($_POST, $data);
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
								<a href="courses.php">
									الدورات
									<span class="selected"></span>
								</a>
							</li>
							<li class="active">
								تعديل بيانات دورة
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
								تعديل بيانات دورة
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
											<label class="col-sm-2 control-label"> فئة الدورة</label>
											<div class="col-sm-10">
												<select name="cat_id" class="form-control">
													<option> اختر الفئة </option>

													<?php
													$i = 0;
													$users = $db->getCategories();
													if (isset($users)) $i++;
													foreach ($users as $u) : $i++;
													?>
														<option value="<?= $u['id'] ?>" <?php
																						echo ($user['cat_id'] == $u['id']) ? 'selected' : '';
																						?>> <?= $u['name'] ?> </option>
													<?php endforeach; ?>

												</select>
											</div>
										</div>



										<div class="form-group">

											<label class="col-sm-2 control-label">
												اسم الدورة </label>
											<div class="col-sm-10">
												<input class="form-control" id="name" name="name" placeholder="اسم الدورة" required="required" type="text" value="<?= $user['name'] ?>" />



											</div>
										</div>
										<div class="form-group">

											<label class="col-sm-2 control-label">
												الاسم المختصر </label>
											<div class="col-sm-10">
												<input class="form-control" id="shortname" name="shortName" placeholder=" course short name from Moodle" required="required" type="text" value="<?= $user['shortName'] ?>" />



											</div>
										</div>
										<div class="form-group">

											<label class="col-sm-2 control-label">
												رقم الدوره بمنصه الموودل </label>
											<div class="col-sm-10">
												<input class="form-control" id="course_moodle_id" name="course_moodle_id" placeholder="take it from Moodle URL of the Course" required="required" type="text" value="<?= $user['course_moodle_id'] ?>" />



											</div>
										</div>

										<div class="form-group">

											<label class="col-sm-2 control-label">
												وصف الدورة
											</label>
											<div class="col-sm-10">
												<textarea rows='10' cols="20" class=form-control placeholder=وصف الدورة required=required id="description" name="description" rows="2"><?= $user['description'] ?></textarea>



											</div>
										</div>




										<div class="form-group">

											<label class="col-sm-2 control-label">
												المدة
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="period" name="period" placeholder="مدة الدورة " required="required" type="text" value="<?= $user['period'] ?>" />



											</div>
										</div>




										<div class="form-group">

											<label class="col-sm-2 control-label">
												التكلفة
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="cost" name="cost" placeholder=" بالجنية المصرى " required="required" type="text" pattern="[0-9]+" value="<?= $user['cost'] ?>" />



											</div>
										</div>



										<div class="form-group">

											<label class="col-sm-2 control-label">
												عدد الساعات
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="NoOfHours" name="NoOfHours" placeholder="عدد الساعات " required="required" type="text" pattern="[0-9]+" value="<?= $user['NoOfHours'] ?>" />



											</div>
										</div>



										<div class="form-group">

											<label class="col-sm-2 control-label">
												عدد المحاضرات
											</label>
											<div class="col-sm-10">
												<input class="form-control" id="NoOfLectures" name="NoOfLectures" placeholder="عدد المحاضرات " required="required" type="text" pattern="[0-9]+" value="<?= $user['NoOfLectures'] ?>" />



											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">صورة</label>
											<div class="col-sm-10">
												<input type="url" name="pic" id="pic" class="form-control" required value="<?= $user['pic'] ?>">
												<img src="<?= $user['pic'] ?>" style='width:200px'>
											</div>
										</div>
									</div>
									<div class="box-footer">
										<button class="btn btn-info pull-right" type="submit">تعديل</button>
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