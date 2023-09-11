 <?php
	include('chicklog.php');
	require_once 'DBConnect.php';
	$db = new DBConnect();
	$section = 'trainfields';
	$sesion = 'addTrFd';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$p = basename($_SERVER['PHP_SELF']);
		$result = $db->addTrField($_POST);
		if ($result['status'])
			$db->success($result['msg'], $sesion, $p);
		else
			$db->wrong($result['msg'], $sesion, $p);
	}
	if (isset($_GET['dell'])) {
		$data['id'] = $_GET['dell'];
		$db->delTrField($data);
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

 							</li>
 							<li class="active">
 								مجالات التدريب
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
 								إضافة مجال تدريب جديد
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
 											<label class="col-sm-2 control-label">اسم المجال</label>
 											<div class="col-sm-10">
 												<input type="text" name="name" id="subject" class="form-control" required>

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
 								مجالات التدريب
 							</div>
 							<div class="panel-body">
 								<table id="example" class="table table-striped table-bordered" style="width:100%">
 									<thead>
 										<tr>
 											<th style="width: 90%;">اسم المجال</th>

 											<th style="width: 10%;">تحكم</th>
 										</tr>
 									</thead>
 									<tbody>
 										<?php
											$i = 0;

											$users = $db->getTrainFlds();
											if (is_array($users))
												foreach ($users as $u) : $i++;
											?>
 											<tr>
 												<td><?= $u['name'] ?></td>
 												<td>
 													<a href="trainingFields.php?dell=<?= $u['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
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