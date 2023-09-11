<?php
$filename = $_POST['csvFile'];
$file = fopen($filename, "w"); // file creation

$title = array('username', 'password', 'firstname', 'lastname', 'email', 'idnumber', 'phone1', 'course1', 'group1');


fputcsv($file, $title);

$export_data = $_POST['export_data'];

foreach ($export_data as $line) {

  $str_arr = explode(",", $line);
  // echo '<pre>';
  // print_r($str_arr);
  // echo '</pre>';

  fputcsv($file, $str_arr);
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=" . $filename);
header("Content-Type: application/csv; ");

readfile($filename);

// deleting file
unlink($filename);
exit();
