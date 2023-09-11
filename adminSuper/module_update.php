<?php
include('db.php');
$id = $_GET['id']; //echo $id;
$state= $_GET['state'];//echo $state;
$table=$_GET['table'];//echo $table;
$field=$_GET['field'];//echo $field;
// $_GET['onoffswitch-checkbox'] ?? I don't think you need this...
// $id = my database row id
// $state = on/off
 mysqli_query($MySQL_Handle,"UPDATE ".$table." SET ".$field." = '".$state."'  WHERE id='".$id."'")or die ('<div class="error_box">لم يتم تعديل حالة الشهادة</div>'.mysql_error());
