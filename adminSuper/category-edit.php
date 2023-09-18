<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'admins';
$sesion = 'editCeUs';

if (isset($_GET['edit'])) {
	$data['id'] = $_GET['edit'];
	$result = $db->getCategories($data);
	$user = $result[0];
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo $data['id'];
	$p = basename($_SERVER['PHP_SELF']);
	if(isset($_SERVER["QUERY_STRING"]));
	{
		$p =$p.'?'.$_SERVER["QUERY_STRING"];
	}
	$result = $db->editCategories($_POST, $data);
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
                                <a href="categories.php">
                                    فئات الدورات
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="active">
                                تعديل بيانات فئة

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
                                تعديل بيانات فئة
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
                                            <label class="col-sm-2 control-label">اسم الفئة</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name" value="<?= $user['name'] ?>"
                                                    class="form-control" required>

                                            </div>
                                        </div>
                                        <!-- 										<div class="form-group">
											<label class="col-sm-2 control-label">صورة التصنيف</label>
											<div class="col-sm-10">
												<input type="url" name="pic" id="pic" value="<?= $user['pic'] ?>"  class="form-control" >
												<img src="<?= $user['pic'] ?>" style='width:200px'>
											</div>
										</div> -->

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