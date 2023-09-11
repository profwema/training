 <?php
    include('chicklog.php');
    require_once 'DBConnect.php';
    $db = new DBConnect();
    $section = 'groups';

    if (isset($_GET['groupId'])) {
        $data['id'] = $_GET['groupId'];
        $result = $db->getGroups($data);
        $group = $result[0];
        $courseData['id'] = $group['course_id'];
        $courseShortVame = $db->getCourseShortName($courseData);
    }






    ?>
 <!DOCTYPE html>
 <html>
 <?php
    include('layout/head.php');
    ?>

 <body class="rtl">
     <!-- start: HEADER -->
     <?php
        include('layout/header.php');
        ?>
     <!-- end: HEADER -->
     <!-- start: MAIN CONTAINER -->
     <div class="main-container">
         <!-- start: NAVBAR -->
         <?php
            include('layout/navbar.php');
            ?>
         <!-- evd: NAVBAR -->
         <!-- start: PAGE -->
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
                                 <a href="groups.php">
                                     المجموعات الدراسية
                                     <span class="selected"></span>
                                 </a>
                             </li>
                             <li class="active">
                                 الاعضاء المسجلين فى المجموعة
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
                                 الاعضاء المسجلين فى المجموعة الدراسية <?= $group['name'] ?>
                             </div>
                             <div class="panel-body">
                                 <form method='post' action='download.php'>
                                     <table id="example" class="table table-striped table-bordered" style="width:100%">
                                         <thead>
                                             <tr>
                                                 <td>اسم الطالب</td>
                                                 <td>اسم الدخول</td>
                                                 <td>البريد الالكترونى</td>
                                                 <td>الهاتف</td>
                                                 <td>تاريخ التسجيل فى البرنامج</td>
                                                 <td>إلغاء</td>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php
                                                // $user_arr[] = array('username', 'password', 'firstname', 'lastname', 'email', 'city', 'country', 'idnumber', 'phone1',  'course1', 'group1');

                                                $i = 0;
                                                $arr['group_id'] = $group['id'];
                                                $usersReg = $db->getCoursesReg($arr);
                                                if (is_array($usersReg))
                                                    foreach ($usersReg as $usersReg) : $i++;
                                                        $userData['id'] = $usersReg['user_id'];
                                                        $resultUsers = $db->getUsers($userData);
                                                        $user = $resultUsers[0];


                                                        $username = $user['user'];
                                                        $password = $user['pass'];
                                                        $firstname = $user['ar_name'];
                                                        $lastname = '';
                                                        $email = $user['email'];
                                                        $idnumber = ($user['idType'] == 1) ? $user['idNo'] : $user['passNo'];
                                                        $phone1 = $user['whatsApp'];
                                                        $course1 = $courseShortVame;
                                                        $group1 = $group['name'];
                                                        $user_arr = "$username,$password,$firstname,$lastname,$email,$idnumber,$phone1,$course1,$group1";

                                                ?>


                                                 <tr>
                                                     <td><?= $firstname  ?></td>
                                                     <td><?= $username ?></td>
                                                     <td><?= $email ?></td>
                                                     <td><?= $phone1 ?></td>
                                                     <td><?= $usersReg['reg_time'] ?></td>
                                                     <td>
                                                         <a href="?dell=<?= $usersReg['id'] ?>" title='حذف'><img src='assets/images/del.png' alt='del'></a>
                                                         <input type="hidden" name='export_data[]' value='<?= $user_arr ?>'>
                                                     </td>
                                                 </tr>

                                             <?php



                                                    endforeach; ?>
                                         </tbody>
                                     </table>
                                     <?php

                                        ?>

                                     <input type="hidden" name='csvFile' value='usersIn_<?= $course1 . '-' . $group1 ?>.csv'>
                                     <input type='submit' value='Export' name='Export'>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end: PAGE CONTENT-->
             </div>
         </div>
         <!-- end: PAGE -->
     </div>
     <!-- end: MAIN CONTAINER -->

     <!-- start: LEFT SIDEBAR -->
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