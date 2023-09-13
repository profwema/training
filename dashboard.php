<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();

if (!isset($_SESSION['user'])) {
  header("Location:login.php ");
}

if (isset($_GET['dell'])) {
  $data['id'] = $_GET['dell'];
  $db->delCourseReg($data);
}

if (isset($_GET['pay'])) {
  $data['id'] = $_GET['pay'];
  $db->payCourseReg($data);
}

if (isset($_GET['putAtGroup'])) {
  $cond['id']       = $_GET['putAtGroup'];
  $data['group_id'] = $_GET['gr'];
  $db->editCourseReg($data, $cond);
}
?>

<!DOCTYPE html>
<html>
<?php require_once("head.php"); ?>

<body class="home-page">



    <div id="page_wrapper">
        <?php require_once("header.php"); ?>

        <div class="page" style="min-height: 800px;">
            <nav aria-label="breadcrumb" class='bread'>
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">الرئيسية </a></li>
                        <li class="breadcrumb-item"><span> <?= $_SESSION['ar_name'] ?> : لوحة القيادة </span></li>

                    </ol>
                </div>
            </nav>


            <div class="container">
                <div class="row">
                    <div class="single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">
                        <div class="col-lg-3">
                            <div class="dashbord-list">
                                <ul>
                                    <li class="active">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-list"></i> الدورات الملتحق بها
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <!-- updateInf.php -->
                                            <i class="fa fa-id-card"></i> معلومات شخصية
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="dashbord-section">
                                <?php
                $i = 0;

                $array['user_id'] = $_SESSION['user'];

                $courses_reg = $db->getCoursesReg($array);

                if (is_array($courses_reg))
                  foreach ($courses_reg as $courseReg) : $i++;
                    include 'reg_to_group.php';
                  endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>

</html>