<?php
include('chicklog.php');
require_once 'DBConnect.php';
$db = new DBConnect();
$section = 'nstractors';
$sesion = 'addInst';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $p = basename($_SERVER['PHP_SELF']);
   $result = $db->addIntractor($_POST);
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
                        <a href="instractors.php">
                           المدربين
                           <span class="selected"></span>
                        </a>
                     </li>
                     <li class="active">
                        إضافة مدرب جديد

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
                        إضافة مدرب جديد
                     </div>
                     <div class="panel-body">
                        <?php
                        if (isset($_SESSION[$sesion])) {
                           echo $_SESSION[$sesion];
                           unset($_SESSION[$sesion]);
                        }
                        ?>
                        <form action="" method="post" id='cat-form' class="form-horizontal">
                           <div class="box-body">
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    اسم المدرب </label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="الاسم بالكامل" value="" required="required" />
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    البريد الألكتروني</label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder='---@---.--' required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    الرقم القومى</label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="text" name="idNo" pattern="[0-9]{14,14}" placeholder='تأكد من ادخال ال 14 رقم من اليسار الي اليمين' required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    السن
                                 </label>
                                 <div class="col-sm-10">
                                    <input class="form-control" id="age" name="age" placeholder="" required="required" type="text" pattern="[0-9]+" />
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    الهاتف
                                 </label>
                                 <div class="col-sm-10">
                                    <input class="form-control" id="phone" name="phone" placeholder='رقم الهاتف' required="required" type="text" pattern="[0-9]+" />
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    رقم واتس أب
                                 </label>
                                 <div class="col-sm-10">
                                    <input class="form-control" id="whatsapp" name="whatsapp" placeholder='تواصل WhatsApp' required="required" type="text" pattern="[0-9]+" />
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label"> الكلية</label>
                                 <div class="col-sm-10">
                                    <select name="faculty" class="form-control">
                                       <option> اختر من القائمة </option>
                                       <?php
                                       $i = 0;
                                       $users = $db->getFaculties();
                                       if (isset($users)) $i++;
                                       foreach ($users as $u) : $i++;
                                       ?>
                                          <option value="<?= $u['id'] ?>"> <?= $u['name'] ?> </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">
                                    المؤهل العلمى </label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="text" id="qual" name="qualification" placeholder=" اخر مؤهل علمى حاصل عليه" value="" required="required" />
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-sm-2 control-label">الدرجة العلمية</label>
                                 <div class="col-sm-10">
                                    <select name="degree" class="form-control">
                                       <option> اختر من القائمة </option>
                                       <?php
                                       $i = 0;
                                       $users = $db->getDegrees();
                                       if (isset($users)) $i++;
                                       foreach ($users as $u) : $i++;
                                       ?>
                                          <option value="<?= $u['id'] ?>"> <?= $u['name'] ?> </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-2 control-label">مجال التدريب </label>
                                 <div class="col-sm-10">
                                    <select name="trainingField" class="form-control">
                                       <option> اختر من القائمة </option>
                                       <?php
                                       $i = 0;
                                       $users = $db->getTrainFlds();
                                       if (isset($users)) $i++;
                                       foreach ($users as $u) : $i++;
                                       ?>
                                          <option value="<?= $u['id'] ?>"> <?= $u['name'] ?> </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
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