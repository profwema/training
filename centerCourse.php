<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();
if (isset($_GET['course'])) {
    $data['id'] = $_GET['course'];
    $courses = $db->getCourses($data);
    $course = $courses[0];
    $center['id'] = $course['Center_fk'];
    $centerName = $db->getCenterName($center);
    $cat['id'] = $course['cat_id'];
    $catName = $db->getCategoryName($cat);
}
?>
<!DOCTYPE html>
<html>
<?php require_once('head.php');
?>

<body class="home-page">



    <div id="page_wrapper">
        <?php require_once("header.php"); ?>

        <div class="page" style="min-height: 800px;">
            <nav aria-label="breadcrumb" class='bread'>
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">الرئيسية </a></li>
                        <li class="breadcrumb-item">
                            <a href="centercats.php?center=<?= $center['id'] ?>">
                                <?= $centerName ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span>
                                <?= $course['name'] ?>
                            </span>
                        </li>
                    </ol>
                </div>
            </nav>
            <div class='container'>
                <div class='row'>
                    <div class='single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp' data-wow-delay='400ms'>

                        <div class='col-lg-8'>
                            <div class='course-name'>
                                <?= $course['name'] ?>
                            </div>

                            <div class='course-category'>
                                <span> فئة الدورة : </span>
                                <?= $catName ?>
                            </div>
                            <div class='course-disc'>
                                <span> : نبذه عن الدورة </span>
                                <?= $course['description'] ?>
                            </div>
                            <div class='course-sub'>
                                <span> : موضوعات الدورة </span>



                                <?php
                                $sub['course_id'] = $course['id'];
                                $subjects = $db->getSubjects($sub);
                                if (is_array($subjects))
                                    foreach ($subjects as $subject) :;
                                ?>
                                    <div class='sub'>
                                        <img src="images/icon.png">
                                        <?= $subject['subject']; ?>
                                    </div>
                                <?php
                                    endforeach;
                                ?>

                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='courses-details'>
                                <img src=" <?= $course['pic'] ?>" alt=''>
                                <div class='cost'>
                                    <?= number_format((float)$course['cost'], 2, '.', '') ?>
                                    جنية
                                </div>
                                <div class='detail'>
                                    <span class="title">مدة الدورة </span>
                                    <div class="value"><?= $course['period'] ?></div>
                                </div>
                                <hr>
                                <div class='detail'>
                                    <span class="title">عدد الساعات</span>
                                    <div class="value"><?= $course['NoOfHours'] ?> ساعة </div>
                                </div>
                                <hr>
                                <div class='detail'>
                                    <span class="title">عدد المحاضرات</span>
                                    <div class="value"><?= $course['NoOfLectures'] ?> محاضرة </div>
                                </div>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $_SERVER['REQUEST_METHOD'] = '';
                                    $result = $db->insert('users_registed', $_POST);
                                    if ($result) {
                                ?>
                                        <div class="course-registed">
                                            تم تسجيل طلبك للالتحاق بالدورة بنجاح
                                            <a href="dashboard.php">اكمل اجراءاتك لتفعيل الاشتراك</a>
                                        </div>
                                    <?php

                                    }
                                } elseif (isset($_SESSION['user'])) {
                                    $regCourse['user_id'] = $_SESSION['user'];
                                    $regCourse['course_id'] = $course['id'];
                                    if ($db->isExist('users_registed', $regCourse)) {
                                    ?>
                                        <div class="course-ouredy">
                                            انت ملتحق بالدورة مسبقا
                                            <a href="dashboard.php">تابع تطورات الالتحاق والدراسة </a>

                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                            <input type="hidden" name='user_id' value='<?= $_SESSION['user'] ?>'>
                                            <input type="hidden" name='center_id' value='<?= $course['Center_fk'] ?>'>
                                            <input type="hidden" name='cat_id' value='<?= $course['cat_id'] ?>'>
                                            <input type="hidden" name='course_id' value='<?= $course['id'] ?>'>
                                            <center>
                                                <button type="submit">
                                                    طلب التحاق بالدورة
                                                </button>
                                            </center>
                                        </form>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="course-require">
                                        تحتاج لتسجيل الدخول لكى تتمكن من الالتحاق بالدورة
                                        <a href="login.php">تسجيل الدخول</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('footer.php');
        ?>
</body>

</html>