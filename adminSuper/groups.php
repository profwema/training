 <?php
	include('chicklog.php');
	require_once 'DBConnect.php';
	$db = new DBConnect();
	$section = 'groups';

	if (isset($_GET['dell'])) {
		$data['id'] = $_GET['dell'];

		$db->delGroup($data);
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
                                 المجموعات الدراسية
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
                                 المجموعات الدراسية
                             </div>
                             <div class="panel-body">

                                 <div class="new">
                                     <a href="group-Add.php"> اضافة مجموعة دراسية جديدة</a>
                                 </div>
                                 <table id="example" class="table table-striped table-bordered" style="width:100%">
                                     <thead>
                                         <tr>
                                             <th style="width: 15%;">اسم المحموعة</th>
                                             <th style="width: 20%;">خاصه بدورة</th>
                                             <th style="width: 15%;"> اسم المدرب</th>
                                             <th style="width: 10%;"> بداية الدراسة</th>
                                             <th style="width: 10%;">السعة الدنيا</th>
                                             <th style="width: 10%;"> السعة القصوى</th>
                                             <th style="width: 10%;"> الطلاب المسجلين</th>
                                             <th style="width: 10%;">تحكم</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
											$i = 0;
											$arr['Center_fk'] = $_SESSION['Center'];
											if (isset($_GET['courseId'])) 
												$arr['course_id'] = $_GET['courseId'];
											$users = $db->getGroups($arr);
											if (is_array($users))
												foreach ($users as $u) : $i++;
											?>
                                         <tr>
                                             <td><?= $u['name'] ?></td>
                                             <td>
                                                 <?php
														$data['id'] = $u['course_id'];
														echo $db->getCourseName($data);
														?>
                                             </td>
                                             <td>
                                                 <?php
														$data['id'] = $u['inst_id'];
														echo $db->getInstractorName($data);
														?>
                                             </td>
                                             <td><?= $u['Start_date'] ?></td>
                                             <td><?= $u['Min_No'] ?></td>
                                             <td><?= $u['Max_No'] ?></td>
                                             <td>
                                                 <?php
												 	$regNo['group_id'] = $u['id'];
                              			$usersReg = $db->getCoursesReg($regNo);
                              			$noOfRegs = (is_array($usersReg)) ? count($usersReg) : 0;
													?>
                                                 <a href="regAtGroup.php?groupId=<?= $u['id'] ?>" title=''>
                                                     <?=$noOfRegs?>
                                                 </a>
                                             </td>
                                             <td>
                                                 <a href="group-edit.php?edit=<?= $u['id'] ?>" title='تعديل'><img
                                                         src='assets/images/edit.png' alt='edit'></a>
                                                 <a href="groups.php?dell=<?= $u['id'] ?>" title='حذف'><img
                                                         src='assets/images/del.png' alt='del'></a>
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