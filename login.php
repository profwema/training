<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();
if (isset($_SESSION['user'])) {
    header("Location:dashboard.php");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Array = [];
    $error = '';

    foreach ($_POST as $key => $value) {
        $Array[$key] = $db->legal_input($value);
    }

    $result = $db->login('users', $Array);
    if (is_array($result)) {
        $db->goAhed($result[0]);
    } elseif ($result) {
        $error .= "بيانات تسجيل الدخول غير صحيحة";
    } else {
        $error .= "Sorry but there is something error";
    }
}

?>
<!DOCTYPE html>
<html>
<?php require_once("head.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


});
</script>

<body class="home-page">
    <div id="page_wrapper">
        <?php require_once("header.php"); ?>

        <div class="page" style="min-height: 800px;">

            <nav aria-label="breadcrumb" class='bread'>
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">الرئيسية </a></li>
                        <li class="breadcrumb-item"><span> تسجيل الدخول</span></li>
                    </ol>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">

                        <div class="col-lg-6">
                            <?php
                        if (isset($error)) {
                        ?>
                            <div class="alert worng">
                                <?= $error ?>
                            </div>
                            <?php
                        }
                        ?>
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                <div class="form-group">
                                    <div class="name"> بيانات تسجيل الدخول *</div>
                                    <div class="form-row">
                                        <label for="user">اسم الدخول</label>
                                        <div class="controls">
                                            <input type="text" autocomplete=off name="user" id="user" required>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <label for="pass">كلمة السر</label>
                                        <div class="controls">
                                            <input type="password" name="pass" id="pass" autocomplete=off required>
                                            <span toggle="#pass" title="اظهار الباسورد"
                                                class="fa fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                    <div class="form-row form-submit">
                                        <!--                                         <div class='col-lg-8'>
                                            <div class='forgetPass'>
                                                نسيت كلمة السر
                                            </div>
                                        </div>
                                        <div class='col-lg-4'>
                                            <center>
                                                <button class="btn submit" id='submit' type="submit">دخول </button>
                                            </center>
                                        </div> -->
                                        <center>
                                            <button class="btn submit" id='submit' type="submit">دخول </button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="newAcount">
                                <div class="name"> لبس لديك حساب بالفعل : قم بانشاء حساب جديد</div>
                                <div class='typeC'>
                                    <a href="#">انشاء حساب لطالب بالمرحلة الجامعية بالجامعة</a>
                                </div>
                                <div class='typeC'>
                                    <a href="#">انشاء حساب لطالب دراسات عليا بالجامعة</a>
                                </div>
                                <!--                                 <div class='typeC'>
                                    <a href="#">انشاء حساب عضو هيئة تدريس</a>
                                </div> -->
                                <div class='typeC'>
                                    <a href="register.php"> انشاء حساب لدارس من خارج الجامعه</a>
                                </div>
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