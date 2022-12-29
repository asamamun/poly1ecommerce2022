<?php
require "../inc/connection.php";
if(isset($_POST['update'])){
    $newstat = $_POST['status'];
    $iiiid = $_POST['id'];
    $uq = "update orders set status='".$newstat."' where id='".$iiiid."' ";
    $conn->query($uq);
    $message= "Status updated";
    header("location: orders.php");
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $q = "select * from orders where id='".$id."' limit 1";
    $r = $conn->query($q);
    $rr =$r->fetch_assoc();
}
else{
    exit;
}
?>
<?php require "inc/header.php"; ?>
    </head>
    <body class="sb-nav-fixed">
<?php require "inc/nav.php"; ?>
        <div id="layoutSidenav">
<?php require "inc/sidenav.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Order Status</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Orders status management:<?= $message??"";?></li>
                        </ol>
<div id="tableContainer">
    <form action="orderstatus.php?id=<?= $id ?>" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
    Order Status : <select name="status" id="status" required>
        <option value="pe" <?= $rr['status']=="pe"?"selected":""; ?>>Pending</option>
        <option value="pr" <?= $rr['status']=="pr"?"selected":""; ?>>Procesing</option>
        <option value="sh" <?= $rr['status']=="sh"?"selected":""; ?>>Shipped</option>
        <option value="co" <?= $rr['status']=="co"?"selected":""; ?>>Complete</option>
    </select>
    <hr>
    <input type="submit" name="update" value="Update Status">
    </form>
    
</div>
                    </div>
                </main>
 <?php require "inc/footer.php"; ?>
 <script>
    $(document).ready(function () {

    });
 </script>              
    </body>
</html>
