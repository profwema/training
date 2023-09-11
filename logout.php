<?php

session_start();

// if the user is logged in, unset the session
require_once 'adminSuper/DBConnect.php';
$db = new DBConnect();
$db->logout();


?>