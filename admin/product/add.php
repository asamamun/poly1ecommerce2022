<?php
if(isset($_POST['addproduct'])){
    require "../../inc/connection.php";
    $catid = $_POST['category_id'];
    $scatid = $_POST['subcategory_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $sku = $_POST['sku'];
    // $image = $_POST['description'];
    $price = $_POST['price'];
    $q = $_POST['quantity'];
    $d = $_POST['discount'];
    $h = $_POST['hot'];
    $image = null;
    if(isset($_FILES['image'])){
        $image = uniqid().".png";
        move_uploaded_file($_FILES['image']['tmp_name'], "../../assets/products/".$image);
    }
    $i = "insert into products values(null,'".$catid."','".$scatid."','".$name."','".$description."','".$sku."','".$image."','".$price."','".$q."','".$d."','".$h."',null)";
    echo $i;
    $conn->query($i);
    if($conn->affected_rows){
        header("location: ../product.php");
    }
    else{
        exit;
    }

}