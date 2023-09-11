 <?php
	include('chicklog.php');
	require_once 'DBConnect.php';
	$db = new DBConnect();
	$section = 'courses';

	if (isset($_GET['dell'])) {
		$data['id'] = $_GET['dell'];

		$db->delCourse($data);
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
 							<li class="active">
 								الدورات
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
 								الدورات
 							</div>
 							<div class="panel-body">

 								<div class="new">
 									<a href="course-Add.php"> اضافة دورة جديدة</a>
 								</div>
 								<table id="example" class="table table-striped table-bordered" style="width:100%">
 									<thead>
 										<tr>
 											<th style="width: 15%;">اسم الدورة</th>
 											<th style="width: 15%;">صورة</th>
 											<th style="width: 15%;">الفئة</th>
											<th style="width: 15%;">موضوعات الدورة</th>
											<!-- <th style="width: 15%;">المجموعات الدراسية</th> -->
											<th style="width: 15%;">الطلاب المسجلين فى الدورة</th>
 											<th style="width: 10%;">تحكم</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
											$i = 0;
											$arr['Center_fk'] = $_SESSION['Center'];
											$users = $db->getCourses($arr);
											if (is_array($users))
												foreach ($users as $u) : $i++;
											?>
 											<tr>
 												<td><?= $u['name'] ?></td>
 												<td><img src="<?= $u['pic'] ?>" style='width:100px'></td>
 												<td>
 													<?php
														$data['id'] = $u['cat_id'];
														echo $db->getCategoryName($data);
														?>
 												</td>
												 <td>
												 	<a href="subjects.php?courseId=<?= $u['id'] ?>" title='تحديد الموضوعات'>
												 تحديد موضوعات الدورة
													</a>
 												</td>
<!-- 												 <td>
												 <?php
												 	$groupNoData['course_id'] = $u['id'];
                              			$groupNo = $db->getGroups($groupNoData);
                              			$noOfGroups = (is_array($groupNo)) ? count($groupNo) : 0;
													?>
												 	<a href="groups.php?courseId=<?= $u['id'] ?>" title=''>
												 		<?=$noOfGroups?>
													</a>
												 </td> -->
												 <td>
													<?php
												 	$regNo['course_id'] = $u['id'];
                              			$usersReg = $db->getCoursesReg($regNo);
                              			$noOfRegs = (is_array($usersReg)) ? count($usersReg) : 0;
													?>
												 	<a href="regAtCourse.php?courseId=<?= $u['id'] ?>" title=''>
												 		<?=$noOfRegs?>
													</a>
 												</td>												

 												<td>
 													<a href="course-edit.php?edit=<?= $u['id'] ?>" title='تعديل'><img src='assets/images/edit.png' alt='edit'></a>
 													<a href="courses.php?dell=<?= $u['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
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