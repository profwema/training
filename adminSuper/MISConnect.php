<?php

 require_once('configMIS.php');

    $conn = new PDO("sqlsrv:Server=" . DB_SERVER . "," . DB_PORT . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);