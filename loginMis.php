<?php
require_once('configMIS.php');

    $conn = new PDO("sqlsrv:Server=" . DB_SERVER . "," . DB_PORT . ";Database=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SET NOCOUNT ON; EXEC dbo.military_get_faculty;");


$stmt->execute();
$tabResultat = $stmt->fetch();
$rowset = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                    foreach ($rowset as $row) :;
                                ?>
<div>
    <?= $row['faculty_name']; ?>
</div>
<?php
                                    endforeach;









/*     $sth->execute();
    $sth->nextRowset(); */