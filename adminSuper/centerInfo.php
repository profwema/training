<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'center';
//$sesion = 'center';





if (isset($_SESSION['Center']) )
{
	$data['id'] = $_SESSION['Center'];
	$result = $db->getCenters($data);
	$u = $result[0];
}



/* if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo $data['id'];
	$p = basename($_SERVER['PHP_SELF']);
	if(isset($_SERVER["QUERY_STRING"]));
	{
		$p =$p.'?'.$_SERVER["QUERY_STRING"];
	}
	$result = $db->editCenter($_POST, $data);
 	if ($result['status'])
		$db->success($result['msg'], $sesion, $p);
	else
		$db->wrong($result['msg'], $sesion, $p);
}  */
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
                            <li class="active">
                                بيانات المركز
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
                                بيانات المركز
                            </div>
                            <div class="panel-body">
                                <div class="new">
                                    <!-- <a href="centerAdmin-Add.php">	اضافة مركز جديد</a> -->
                                </div>
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>المركز</th>
                                            <th>الشعار</th>
                                            <th> منصه التدريب</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $u['name'] ?></td>
                                            <td><img src="../images/logos/<?= $u['logo'] ?>" alt='' style='width:100px'>
                                            </td>
                                            <td>
                                                <a class='login' target="_blank"
                                                    href="https://training.tanta.edu.eg/<?= $u['moodle_url'] ?>">
                                                    https://training.tanta.edu.eg/<?= $u['moodle_url'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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