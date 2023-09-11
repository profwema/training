<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section='admins'; 

if(isset($_GET['dell']))
{
	$data['id'] = $_GET['dell'];

	$db->delUserCenter($data);
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
									 مشرفي المراكز			
								
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
									 مشرفي المراكز
								</div>									
								<div class="panel-body">

									<div class="new">
										<a href="centerAdmin-Add.php">	اضافة مشرف جديد</a>
									</div>
									<table  id="example" class="table table-striped table-bordered" style="width:100%">	
										<thead>
											<tr>
												<th style="width: 40%;">اسم المستخدم</th>
												<th style="width: 40%;">المركز</th>
												<th style="width: 10%;">تحكم</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$i=0;
											$users = $db->getCenterUsers();
											
											if(isset($users)) 
												foreach($users as $u): $i++;
										?>
											<tr>
												<td><?=$u['username']?></td>
												<td>
													<?php 
													 $data['id'] = $u['Center_fk'];
													 echo $db->getCenterName($data);
													?>
												</td>
												<td>
													<a href="centerAdmin-edit.php?edit=<?=$u['id']?>" title='تعديل'><img src='assets/images/edit.png' alt='edit'></a>
													<a href="centerAdmins.php?dell=<?=$u['id']?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
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