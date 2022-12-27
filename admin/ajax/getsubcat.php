<?php
require "../../inc/connection.php";
$q = "select * from subcategories where category_id ='".$_GET['c']."' ";
$scat = $conn->query($q);
$rows = [];
while($row = $scat->fetch_assoc()){
    $rows[] = $row;
}
echo json_encode($rows);