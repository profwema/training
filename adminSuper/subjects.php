 <?php
	include('chicklog.php');
	require_once 'DBConnect.php';
	$db = new DBConnect();
	$section = 'courses';
	$sesion = 'addSub';

	$p = basename($_SERVER['PHP_SELF']);
	if (isset($_SERVER["QUERY_STRING"])); {
		$p = $p . '?' . $_SERVER["QUERY_STRING"];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//$data = array_merge($_POST,$_FILES);

		$result = $db->addSubject($_POST);
		if ($result['status'])
			$db->success($result['msg'], $sesion, $p);
		else
			$db->wrong($result['msg'], $sesion, $p);
	}

	if (isset($_GET['courseId'])) {
		$data['id'] = $_GET['courseId'];
		$result = $db->getCourses($data);
		$user = $result[0];
	}

	if (isset($_GET['dell'])) {
		$data['id'] = $_GET['dell'];

		$db->delSubject($data, $p);
	}



	?>


 <!DOCTYPE html>
 <html>
 <?php
	include('layout/head.php');
	?>

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
 								موضوعات الدورة
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
 								إضافة موضوغ جدديد لدورة <?= $user['name'] ?>
 							</div>
 							<div class="panel-body">
 								<?php
									if (isset($_SESSION[$sesion])) {
										echo $_SESSION[$sesion];
										unset($_SESSION[$sesion]);
									}
									?>
 								<form action="" method="post" enctype="multipart/form-data" id='cat-form' class="form-horizontal">
 									<div class="box-body">
 										<div class="form-group">
 											<label class="col-sm-2 control-label">الموضوع</label>
 											<div class="col-sm-10">
 												<input type="text" name="subject" id="subject" class="form-control" required>
 												<input type="hidden" name="course_id" value="<?= $user['id'] ?>">
 											</div>
 										</div>

 									</div>
 									<div class="box-footer">
 										<button class="btn btn-info pull-right" type="submit">إضافة</button>
 									</div>
 								</form>
 							</div>
 						</div>
 						<div class="panel panel-default">
 							<div class="panel-heading">
 								<i class="fa fa-external-link-square"></i>
 								موضوعات دورة --- <?= $user['name'] ?>
 							</div>
 							<div class="panel-body">
 								<table id="example" class="table table-striped table-bordered" style="width:100%">
 									<thead>
 										<tr>
 											<th style="width: 90%;">الموضوعات</th>

 											<th style="width: 10%;">تحكم</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
											$i = 0;
											$arr['course_id'] = $user['id'];
											$users = $db->getSubjects($arr);
											if (is_array($users))
												foreach ($users as $u) : $i++;
											?>
 											<tr>
 												<td><?= $u['subject'] ?></td>
 												<td>
 													<a href="subjects.php?dell=<?= $u['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
 												</td>
 											</tr>
 										<?php endforeach; ?>
 									</tbody>
 								</table>
 							</div>
 						</div>
 					</div>
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