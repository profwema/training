<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();

if (!isset($_SESSION['user'])) {
  header("Location:login.php ");
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
                        <li class="breadcrumb-item"> إدارة الحساب </span></li>
                    </ol>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div>
                        مرحبا :
                        <?= $_SESSION['ar_name'] ?>
                    </div>
                    <div class="single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">
                        <div class="col-lg-3">
                            <div class="dashbord-list">
                                <ul>
                                    <li>
                                        <a href="dashboard.php">
                                            <i class="fa fa-list"></i> الدورات المشترك فيها
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-user-circle"></i> اعدادات الحساب
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <i class="fa fa-sign-out"></i> تسجيل الخروج
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="dashboardTitle">معلومات الحساب</div>
                            <div class="dashbord-section">
                                <?php
                                $array['id'] = $_SESSION['user'];
                                $users = $db->getUsers($array);
                                $user = $users[0];
                                ?>
                                <div class='userInf'>
                                    <table>
                                        <caption style="caption-side:top"> بيانات تسجيل الدخول</caption>
                                        <tr>
                                            <th> اسم الدخول :</th>
                                            <td><?= $user['user'] ?></td>
                                        </tr>
                                        <tr>
                                            <th> كلمة السر :</th>
                                            <td><?= $user['pass'] ?></td>
                                        </tr>
                                    </table>
                                    <table>
                                        <caption style="caption-side:top">بيانات التواصل</caption>
                                        <tr>
                                            <th> البريد الإلكتروني:</th>
                                            <td><?= $user['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>رقم whatsapp :</th>
                                            <td>
                                                <?= $user['whatsApp'] ?>
                                            </td>
                                            <td style='display:none'>
                                                <input type="text" name='whatsApp' value="<?= $user['whatsApp'] ?>">

                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <caption style="caption-side:top">بيانات شخصية </caption>
                                        <tr>
                                            <th> الاسم باللغة العربية :</th>
                                            <td><?= $user['ar_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>الاسم باللغة الانجليزية :</th>
                                            <td><?= $user['en_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>تاريخ الميلاد :</th>
                                            <td><?= $user['birthdate'] ?></td>
                                        </tr>
                                        <tr>
                                            <th> النوع :</th>
                                            <td><?= ($user['geder']==1)? 'ذكر':'أنثى' ?></td>
                                        </tr>
                                        <tr>
                                            <th> اثبات الشخصية :</th>
                                            <td><?= ($user['idType']==1)? 'رقم قومي':'جواز سفر' ?></td>
                                        </tr>
                                        <tr>
                                            <th>رقمها :</th>
                                            <td><?= ($user['idType']==1)? $user['idNo']:$user['passNo'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>المهنه :</th>
                                            <td><?= $user['job'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>المؤهل العلمي :</th>
                                            <td><?= $user['qualification'] ?></td>
                                        </tr>
                                    </table>
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