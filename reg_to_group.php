<?php

$coursedata['id'] = $courseReg['course_id'];
$courses = $db->getCourses($coursedata);
$course = $courses[0];
$courseName = $course['name'];


$centerData['id'] = $course['Center_fk'];
$centers = $db->getCenters($centerData);
$center = $centers[0];
$centerName = $center['name'];

$cat['id'] = $course['cat_id'];
$catName = $db->getCategoryName($cat);
?>
<div class="course-reg">
   <div class="row">
      <div class="col-md-3 col-sm-4">
         <div class="news_img">

            <img src="<?= $course['pic'] ?>" alt="">

         </div>
      </div>
      <div class="col-md-9 col-sm-8">
         <div class="course-summary">

            <div class="title">
               <a href="centerCourse.php?course=<?= $course['id'] ?>"><?= $courseName ?></a>
            </div>

            <div class="catName">
               مقدمة من مركز : <?= $centerName ?>
            </div>

            <div class="catName">
               فئة الدورة : <?= $catName ?>
            </div>
         </div>
      </div>
   </div>





   <?php
   if ($courseReg['pay'] == 0) {
   ?>
      <div class="notPayed">
         <img src="images/bad.png" alt="">
         <div>
            عضوية غير مفعله يرجى سداد قيمة الاشتراك <?= $course['cost'] ?> جنية</a>
         </div>
         <div>
            <a class='payNow' href="?pay=<?= $courseReg['id'] ?>"><img src="images/pay.png" alt="">قم بالسداد الآن
            </a>
            <a class='removeNow' href="?dell=<?= $courseReg['id'] ?>"><img src="images/exit.png" alt="">الانسحاب
               من الدورة</a>

         </div>
      </div>
   <?php
   } else {
   ?>
      <div class="group-details">
         <h5> بيانات المجموعه الدراسية</h5>
         <?php
         if ($courseReg['group_id'] == null) {

            $groups = $db->getRegGroups($courseReg['course_id']);
            if (is_array($groups)) {
         ?>
               اختر مجموعتك الدراسية من قائمة المحموعات الدراسية التى لم تبدأ بعد
               <table>
                  <thead>
                     <tr>
                        <th>اسم المجموعة</th>
                        <th>المحاضر</th>
                        <th> بداية الدراسة</th>
                        <th>السعه القصوى </th>
                        <th>الأماكن الشاغرة</th>
                        <th> اختيار</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     foreach ($groups as $group) : $i++;
                        $regNo['group_id'] = $group['id'];
                        $usersReg = $db->getCoursesReg($regNo);
                        $noOfRegs = (is_array($usersReg)) ? count($usersReg) : 0;
                        $noOfRest = $group['Max_No'] - $noOfRegs;
                     ?>
                        <tr>
                           <td><?= $group['name'] ?></td>
                           <td>
                              <?php
                              $inst['id'] = $group['inst_id'];
                              echo $db->getInstractorName($inst);
                              ?>
                           </td>
                           <td><?= $group['Start_date'] ?></td>
                           <td><?= $group['Max_No'] ?></td>
                           <td><?= $noOfRest ?></td>
                           <td>
                              <?php
                              if ($noOfRest == 0)
                                 echo 'العدد مكتمل';
                              else {
                              ?>
                                 <a class='btn btn-success' href="?putAtGroup=<?= $courseReg['id'] ?>&gr=<?= $group['id'] ?>">
                                    اختار</a>
                              <?php
                              }
                              ?>

                           </td>
                        </tr>
                     <?php
                     endforeach;

                     ?>
                  </tbody>
               </table>

            <?php
            } else {
               echo '<p>لا توجد جروبات حاليا </p>';
            }
         } else {
            $dataGroupReg['id'] = $courseReg['group_id'];
            $result = $db->getGroups($dataGroupReg);
            $user = $result[0];
            ?>


            <div class='detail'>
               <span class="title">
                  <i class="fa fa-users" aria-hidden="true"></i> مجموعه :
               </span>
               <div class="value">
                  <?= $user['name'] ?>
               </div>
            </div>
            <div class='detail'>
               <span class="title">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> المحاضر :
               </span>
               <div class="value">
                  <?php
                  $inst['id'] = $user['inst_id'];
                  echo $db->getInstractorName($inst);
                  ?>
               </div>
            </div>
            <div class='detail'>
               <span class="title">
                  <i class="fa fa-calendar" aria-hidden="true"></i> بدء الدراسة :
               </span>
               <div class="value">
                  <?= $user['Start_date'] ?>
               </div>
            </div>

            <?php
            if (strtotime(date('Y-m-d')) < strtotime($user['Start_date'])) {
            ?>
               <div class="stell">
                  <img src="images/4762568.png" alt="">لم تبدأ بعد
               </div>
            <?php
            } else {
            ?>
               <a class='btn btn-success' href="https://training.tanta.edu.eg/<?= $center['moodle_url'] ?>/course/view.php?id=<?= $course['course_moodle_id'] ?>" target="_blank">
                  دخول الى المنصة الدراسية</a>
            <?php
            }
            ?>

         <?php
         }
         ?>
      </div>
   <?php
   }
   ?>

</div>
<hr>