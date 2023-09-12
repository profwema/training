<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['comeFrom'])) {
        header("Location: " . $_SESSION['comeFrom']);
        exit(0);
    }

    header("Location: index.php");
    exit(0);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $insert = true;
    $Array = [];
    $error = [];

    foreach ($_POST as $key => $value) {
        $Array[$key] = $db->legal_input($value);

        if ($key == 'user' || $key == 'email') {
            $word = ($key == 'user') ? 'اسم الدخول' : "البريد الألكتروني";
            $culomn = [];
            $culomn[$key] = $Array[$key];
            if ($db->isExist('users', $culomn)) {
                $insert = false;
                $error[$key] = "نأسف ولكن $word مستخدم من قبل";
            }
        }
    }
    if ($insert) {
        $result = $db->insert('users', $Array);
        if ($result) {
            $db->goAhed($Array);
        } else {
            $error .= "Sorry but there is something error";
        }
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
    $('input[name="idType"]').on('click', function() {
        if ($(this).val() == '2') {
            $('#passp').show();
            $('#passp input[name="passNo"]').prop('required', true);
            $('#natid').hide();
            $('#natid input[name="idNo"]').val('');
            $('#natid input[name="idNo"]').prop('required', false);
        } else {
            $('#natid').show();
            $('#natid input[name="idNo"]').prop('required', true);
            $('#passp').hide();
            $('#passp input[name="passNo"]').val('');
            $('#passp input[name="passNo"]').prop('required', false);
        }
    });
    $('#myCheckbox').click(function() {
        $('#submit').prop("disabled", !$("#myCheckbox").prop("checked"));
    })
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
                        <li class="breadcrumb-item"><span> انشاء حساب جديد</span></li>
                    </ol>
                </div>
            </nav>





            <div class="container">
                <div class="row">
                    <div class="single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">

                        <?php
                        if (isset($error)) {
                        ?>
                        <div class="alert worng">
                            <?= implode('<br>', $error) ?>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- -->
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="name"> بيانات تسجيل الدخول *</div>
                                        <div class="form-row">
                                            <label for="user">اسم الدخول</label>
                                            <div class="controls">
                                                <input type="text" name="user" id="user" pattern="[A-Za-z0-9_-]{1,15}"
                                                    title="Only letters (either case), numbers, and the underscore; no more than 15 characters"
                                                    placeholder='تأكد من صلاحية الاسم' autocomplete="off" required>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="pass">كلمة السر</label>
                                            <div class="controls">
                                                <input type="password" name="pass" id="pass"
                                                    placeholder="حروف كبيره وصغيره وارقام وعلامات خاصة"
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}"
                                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                                    required autocomplete="new-password" required>
                                                <span toggle="#pass" title="اظهار الباسورد"
                                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="name">
                                            بيانات التواصل
                                        </div>
                                        <div class="form-row">
                                            <label for="email">البريد الألكتروني</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="email" name="email"
                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                    placeholder='---@---.--' autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <label for="whatsapp">رقم whatsApp</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" name="whatsapp"
                                                    placeholder='تواصل WhatsApp' autocomplete="off" pattern="[0-9]+">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="name">
                                    بيانات شخصية
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="ar_name">الاسم باللغة العربية</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" name="ar_name"
                                                    placeholder='الاسم رباعي' autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="en_name">الاسم باللغة الانجليزية</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" name="en_name"
                                                    placeholder='الاسم رباعي' autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="birthdate">تاريخ الميلاد</label>
                                            <div class="controls">
                                                <input class="input--style-5" autocomplete="off" type="date"
                                                    name="birthdate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="geder">النوع</label>
                                            <div class="controls">
                                                <label class="radio-inline" id='radlab1'>
                                                    <input type="radio" id='gender1' name="geder" value="1" checked>ذكر
                                                </label>
                                                <label class="radio-inline" id='radlab2'>
                                                    <input type="radio" id='gender2' name="geder" value="2">انثي
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="idType">اثبات الشخصية</label>
                                            <div class="controls">
                                                <label class="radio-inline" id='radlab1'>
                                                    <input type="radio" id='idType1' name="idType" value="1"
                                                        checked>بطاقة رقم قومي
                                                </label>
                                                <label class="radio-inline" id='radlab2'>
                                                    <input type="radio" id='idType2' name="idType" value="2">جواز سفر
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id='natid'>
                                        <div class="form-row">
                                            <label for="idNo">الرقم القومى</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" name="idNo"
                                                    pattern="[0-9]{14,14}" autocomplete="off"
                                                    placeholder='تأكد من ادخال ال 14 رقم من اليسار الي اليمين' required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id='passp' style="display: none;">
                                        <div class="form-row">
                                            <label for="passNo">جواز السفر*</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" name="passNo" pattern="[0-9]"
                                                    autocomplete="off" placeholder='للطلاب الوافدين فقط'>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="job">المهنه</label>
                                            <div class="controls">
                                                <input class="input--style-5" type="text" autocomplete="off" name="job">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <label for="qualification">المؤهل العلمي</label>
                                            <div class="controls">
                                                <input class="input--style-5" autocomplete="off" type="text"
                                                    name="qualification">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox instructions">
                                            <label>
                                                <input type="checkbox" id="myCheckbox">
                                                <span>
                                                    أتعهد بعدم نشر المادة العلمية الخاصة بالتدريب علي الدورات التابعه
                                                    للمركز الرئيسي للتدريب المستدام بما فيها دورات التحول الرقمي وذلك
                                                    حفاظاُ علي حقوق الملكية الفكرية التابعة للمجلس الأعلي للجامعات.
                                                    <br>
                                                    <strong>
                                                        مخالفة هذا التعهد يعرض للمساءلة القانونية.
                                                    </strong>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button class="btn submit" id='submit' type="submit" disabled>تسجيل

                                </button>
                            </center>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>

</html>