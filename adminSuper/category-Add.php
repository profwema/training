<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'categories';
$sesion = 'addCat';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//$data = array_merge($_POST,$_FILES);
	$p = basename($_SERVER['PHP_SELF']);
	$result = $db->addCategory($_POST);
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
                                إضافة فئة جدديدة

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
                                إضافة فئة جدديدة
                            </div>
                            <div class="panel-body">
                                <?php
								if (isset($_SESSION[$sesion])) {
									echo $_SESSION[$sesion];
									unset($_SESSION[$sesion]);
								}
								?>
                                <form action="" method="post" enctype="multipart/form-data" id='cat-form'
                                    class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">اسم الفئة</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <!-- 										<div class="form-group">
											<label class="col-sm-2 control-label">صورة الفئة</label>
											<div class="col-sm-10">
												 <input type="file" 
												class="form-control" placeholder="رابط الصورة" 
												name="pic"> 
												<input type="url" class="form-control" placeholder="رابط الصورة" name="pic">
											</div>
										</div> -->
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-info pull-right" type="submit">إضافة</button>
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