<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();
?>

<!DOCTYPE html>
<html>
<?php require_once("head.php"); ?>

<body class="home-page">
  <div id="page_wrapper">
    <?php require_once("header.php"); ?>
    <div class="page" style="min-height: 800px;">

      <div class=" w3-padding-16 w3-center w3-margin-bottom">

        <div class="container">
          <div class="row">
            <div class="mainCenter">
              <div class="col-lg-4">

                <img src="images/logos/logo.jpg" alt="">


              </div>
              <div class="col-lg-8">
                <div class="summary">
                  <div class="title">
                    منصة التدريب للمركز الرئيسي للتدريب المستدام
                  </div>
                  <div class="disc">تهدف هذه المنصه الى تحقيق الغاية التى أنشئ من أجلها المركز الرئيسي للتدريب
                    المستدام وهى تقديم كافة الأنشطة المتعلقة بخطط تدريب وتنمية قدرات السادة أ.هـ.ت والهيئة
                    المعاونة والعاملين بالجامعة وتقديم خدمات التدريب وتنمية القدرات للمجتمع بأكمله فى العديد من
                    المجالات التى تخدم خطة الدولة الإستراتيجية
                  </div>
                  <div class="contact">
                    <h5>للتواصل </h5>
                    <ul class="list-inline p-0">

                      <li class="list-inline-item">
                        <a href="tel:01222334842"> <i class="fa fa-phone ml-2"></i> 01222334842</a>
                      </li>
                      <li class="list-inline-item">|</li>
                      <li class="list-inline-item">
                        <a href="mailto:mcst@unv.tanta.edu.eg"> <i class="fa fa-envelope ml-2"></i> mcst@unv.tanta.edu.eg</a>
                      </li>
                      <li class="list-inline-item">|</li>
                      <li class="list-inline-item">
                        <a target="_blanck" href="https://www.facebook.com/groups/311561911189233/?ref=share_group_link"> <i class="fa fa-facebook-square ml-2"></i>الصفحة الرسمية على الفيسبوك</a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="section-title">
            <h2> المراكز التابعة</h2>
          </div>
          <div class="row">
            <?php
            $i = 0;
            $users = $db->getCenters();

            if (isset($users)) $i++;
            foreach ($users as $u) : $i++;
            ?>

              <div class="col-lg-4">
                <div class="center">
                  <img src="images/logos/<?= $u['logo'] ?>" alt="">
                  <h3>
                    <span><?= $u['name'] ?> </span>
                  </h3>
                  <div>
                    <a class='register' href="centercats.php?center=<?= $u['id'] ?>">تصفح الدورات</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
    <?php require_once("footer.php"); ?>
  </div>
</body>

</html>