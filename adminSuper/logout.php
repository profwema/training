<?php

session_start();

// if the user is logged in, unset the session

if (isset($_SESSION['logged-in'])) {

unset($_SESSION['logged-in']);
unset($_SESSION['Center']);


}

// now that the user is logged out,

// go to login page

@header('Location: login.php');

?>