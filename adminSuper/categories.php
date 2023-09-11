<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'categories';

if (isset($_GET['dell'])) {
	$data['id'] = $_GET['dell'];

	$db->delCategory($data);
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
								فئات الدورات

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
								فئات الدورات
							</div>
							<div class="panel-body">

								<div class="new">
									<a href="category-Add.php"> اضافة فئة جديدة</a>
								</div>
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th style="width: 40%;">اسم الفئة</th>
											<th style="width: 40%;"></th>
											<th style="width: 10%;">تحكم</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										$arr['Center_fk'] = $_SESSION['Center'];
										$cats = $db->getCategories($arr);

										if (is_array($cats))
											foreach ($cats as $cat) : $i++;
										?>
											<tr>
												<td><?= $cat['name'] ?></td>
												<td>
													<img src="<?= $cat['pic'] ?>" style='width:100px'>
												</td>
												<td>
													<a href="category-edit.php?edit=<?= $cat['id'] ?>" title='تعديل'><img src='assets/images/edit.png' alt='edit'></a>
													<a href="categories.php?dell=<?= $cat['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
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