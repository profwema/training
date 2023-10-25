<?php
require_once('adminSuper/MISConnect.php');

   





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