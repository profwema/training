<?php
session_start();
require_once 'adminSuper/DBConnect.php';
require_once 'pageState.php';
$db = new DBConnect();

if (isset($_GET['center'])) {
  $center['id'] = $_GET['center'];
  $centerName = $db->getCenterName($center);
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
            <li class="breadcrumb-item"><span> <?= $centerName ?></span></li>

          </ol>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="single-top-popular-course d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="400ms">


            <div class="col-lg-4">
              <div class="categories-section">

                <h2>
                  <a href="?center=<?= $center['id'] ?>">فئات الدورات</a>
                </h2>



                <ul>
                  <?php
                  $i = 0;
                  $catFilter['Center_fk'] = $center['id'];
                  $cats = $db->getCategories($catFilter);

                  if (is_array($cats))
                    foreach ($cats as $cat) : $i++;
                  ?>
                    <li>
                      <a class="<?= (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'active' : '' ?>" href="?center=<?= $center['id'] ?>&cat=<?= $cat['id'] ?>">
                        <?= $cat['name'] ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="courses-section">
                <?php
                $i = 0;
                $coursFilter['Center_fk'] = $center['id'];

                if (isset($_GET['cat'])) {
                  $coursFilter['cat_id'] = $_GET['cat'];
                }


                $courses = $db->getCourses($coursFilter);

                if (is_array($courses))
                  foreach ($courses as $course) : $i++;
                ?>
                  <div class="course">
                    <div class="col-lg-4">
                      <img src="<?= $course['pic'] ?>" alt="">
                    </div>
                    <div class="col-lg-8">
                      <div class="course-summary">
                        <div class="title">
                          <?= $course['name'] ?>
                        </div>
                        <div class="catName">
                          <?php
                          $catName['id'] = $course['cat_id'];
                          echo $db->getCategoryName($catName);
                          ?>
                        </div>

                        <div class="period"> مدة الدورة
                          <?= $course['period'] ?>
                        </div>
                        <div class="cost"> سعر الدورة
                          <?= $course['cost'] ?> جنية
                        </div>

                        <a href="centerCourse.php?course=<?= $course['id'] ?>"> تفاصيل الدورة</a>

                      </div>
                    </div>


                  </div>
                  <hr>
                <?php endforeach; ?>

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