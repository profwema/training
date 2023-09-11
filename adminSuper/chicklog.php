<?php
session_start();
// is the one accessing this page logged in or not?
if ( !isset($_SESSION['logged-in'])) 
{
// not logged in, move to login page
@header('Location: login.php');
exit;
}
?>
