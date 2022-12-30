<?php
require "../inc/adminauth.php";
if(isset($_GET['id'])){
    require "../../inc/connection.php";
    $id = $_GET['id'];
    $q = "delete from products where id='{$id}' limit 1";
    $conn->query($q);
    if($conn->affected_rows){
        header("location: ../product.php");
    }    
}