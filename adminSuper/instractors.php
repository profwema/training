 <?php
	include('chicklog.php');
	require_once 'DBConnect.php';
	$db = new DBConnect();
	$section = 'nstractors';

	if (isset($_GET['dell'])) {
		$data['id'] = $_GET['dell'];

		$db->delInstractor($data);
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
 								المدربين
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
 								المدربين
 							</div>
 							<div class="panel-body">

 								<div class="new">
 									<a href="instractor-Add.php"> اضافة مدرب جديد</a>
 								</div>
 								<table id="example" class="table table-striped table-bordered" style="width:100%">
 									<thead>
 										<tr>
 											<th style="width: 25%;">اسم المدرب</th>
 											<th style="width: 25%;">مجال التدريب</th>
 											<th style="width: 15%;">الدرجة العلمية </th>
 											<th style="width: 25%;">البريد الألكتروني</th>
 											<th style="width: 10%;">تحكم</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
											$i = 0;
											$users = $db->getInstractors();
											if (is_array($users))
												foreach ($users as $u) : $i++;
											?>
 											<tr>
 												<td><?= $u['name'] ?></td>
 												<td>
 													<?php
														$data['id'] = $u['trainingField'];
														echo $db->getTrainFldName($data);
														?>
 												</td>
 												<td>
 													<?php
														$data['id'] = $u['degree'];
														echo $db->getDegreeName($data);
														?>
 												</td>
 												<td><?= $u['email'] ?></td>

 												<td>
 													<a href="instractor-edit.php?edit=<?= $u['id'] ?>" title='تعديل'><img src='assets/images/edit.png' alt='edit'></a>
 													<a href="instractors.php?dell=<?= $u['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
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