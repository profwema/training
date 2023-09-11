<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'centers';

if (isset($_GET['dell'])) {
	$data['id'] = $_GET['dell'];

	$db->delCenter($data);
}
?>


<!DOCTYPE html>
<html>
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
								<a href="index.php">
									الرئيسية
									<span class="selected"></span>
								</a>
							</li>
							<li class="active">
								المراكز التابعة

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
								المراكز التابعة
							</div>
							<div class="panel-body">

								<div class="new">
									<!-- <a href="centerAdmin-Add.php">	اضافة مركز جديد</a> -->
								</div>
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>

											<th style="width: 40%;">المركز</th>
											<th style="width: 25%;">الشعار</th>
											<th style="width: 25%;"> منصه التدريب</th>
											<th style="width: 10%;">تحكم</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										$users = $db->getCenters();

										if (isset($users))
											foreach ($users as $u) : $i++;
										?>
											<tr>
												<td><?= $u['name'] ?></td>
												<td><img src="../images/logos/<?= $u['logo'] ?>" alt='' style='width:100px'></td>
												<td>
													<a class='login' target="_blank" href="https://training.tanta.edu.eg/<?= $u['moodle_url'] ?>">https://training.tanta.edu.eg/<?= $u['moodle_url'] ?>
													</a>
												</td>
												<td>
													<!-- <a href="center-edit.php?edit=<?= $u['id'] ?>" title='تعديل'><img src='assets/images/edit.png' alt='edit'></a> -->
													<!-- <a href="centers.php?dell=<?= $u['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a> -->
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