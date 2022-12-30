<?php require "../inc/adminauth.php"; ?>
<?php 
require "../../inc/connection.php"; 

//update
if(isset($_POST['updateproduct'])){
$id = $_POST['id'];
$cid = $_POST['category_id'];
$scid = $_POST['subcategory_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$sku = $_POST['sku'];
$price = $_POST['price'];
$q = $_POST['quantity'];
$d = $_POST['discount'];
$hot = $_POST['hot'];
$update = "UPDATE `products` SET `category_id`='".$cid."',`subcategory_id`='".$scid."',`name`='".$name."',`description`='".$description."',`sku`='".$sku."',`price`='".$price."',`quantity`='".$q."',`discount`='".$d."',`hot`='".$hot."' WHERE id='".$id."'";
$conn->query($update);
if($conn->affected_rows){
    header("location: ../product.php");
}
}

//select
$p = "select * from products where id='".$_GET['id']."' limit 1";
$r = $conn->query($p);
$p = $r->fetch_assoc();
// var_dump($row);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            .smallbox{
                display: inline-block;
                width:15px ;
                height: 15px;                
            }
        </style>
    </head>
    <body class="sb-nav-fixed">

        <div id="layoutSidenav">

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
<!--  -->
<button class="btn btn-primary" id="showFormBtn">+</button>
<div id="productFormContainer">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $p['id'] ?>">
        <label>Category ID</label>
        <select name="category_id" id="category_id">
            <option value="-1">Select</option>
            <?php
            
            $s = "select * from categories where 1";
            $r = $conn->query($s);
            while($row=$r->fetch_assoc()){
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            } 
            ?>
        </select> <br>
        <label>SubCategory ID</label>
        <select name="subcategory_id" id="subcategory_id">
            <option value="-1">Select</option>
        </select> <br>
        <label>Product Name</label>
        <input type="text" name="name" required value="<?= $p['name'] ?>"> <br>
        <label>Description</label>
        <textarea name="description" required><?= $p['description'] ?></textarea> <br>
        <label>Sku</label>
        <input type="text" name="sku" required value="<?= $p['sku'] ?>"> <br>
        <!-- <label>Image</label>
        <input type="file" name="image" required value="<?= $p['name'] ?>"> <br> -->
        <label>Price</label>
        <input type="text" name="price" required value="<?= $p['price'] ?>"> <br>
        <label>Quantity</label>
        <input type="number" name="quantity" required value="<?= $p['quantity'] ?>"> <br>
        <label>Discount(%)</label>
        <input type="text" name="discount" required value="<?= $p['discount'] ?>"> <br>
        <label>Hot</label>
        <select name="hot" id="hot">
            <option value="0" <?= $p['hot']=="0"?"selected":"" ?>>Normal</option>
            <option value="1" <?= $p['hot']=="1"?"selected":"" ?>>Hot</option>
        </select>
        <br>
        <input type="submit" class="btn btn-outline-primary" name="updateproduct" value="Update">
    </form>
</div>
<!--  -->

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="../js/jquery-3.6.3.min.js"></script>
 <script>
    $(document).ready(function () {
        $("#category_id").change(function(){
    
    $.getJSON("../ajax/getsubcat.php",{c:$(this).val()},function(d){
        //alert(d)
        if(d.length){
        populate_sub_category(d);
        }
        else{
            $("#subcategory_id").html("");  
        }
    });
});
function populate_sub_category(d){
    $("#subcategory_id").html("");
    let html = "<option value='-1'>Select</option>";
    d.forEach(e => {
        html += "<option value='"+e.id+"'>"+e.name+"</option>";
    });
    $("#subcategory_id").html(html);
}
    });
 </script>              
    </body>
</html>
