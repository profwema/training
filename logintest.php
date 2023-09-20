<?php
require('config.php');
$name='profwema';
$password='Asd@203112564';
$dashboard = $CFG->wwwroot;
//echo $dashboard;
$user = authenticate_user_login($name, $password);
if(complete_user_login($user))
{

header("Location: ."$dashboard"./course/view.php?id=2");

}
else
{
   echo "not login";
}



?>