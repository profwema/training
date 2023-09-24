<?php
require_once('configMIS.php');

try
{
    $conn = new PDO("sqlsrv:Server=" . DB_SERVER . "," . DB_PORT . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $conn->prepare("SET NOCOUNT ON; EXEC dbo.military_get_faculty;");

    $sth->execute();
    $sth->nextRowset();
    $rowset = $sth->fetchAll(PDO::FETCH_NUM);
    $conn = null;


        echo '<p> <h1>============</h1></p><pre>';
        print_r($rowset);
        echo '</pre>';
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>