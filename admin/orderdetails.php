<?php
if(isset($_GET['id'])){
    require "../inc/connection.php";
    $invid = $_GET['id'];
    $o = "select orders.*,users.username as uname from orders,users where orders.user_id=users.id and orders.id='".$invid."' limit 1";
    $order = $conn->query($o);
    $od = "select orderdetails.*,products.name as pname from orderdetails , products where orderdetails.product_id=products.id and  orderdetails.order_id='".$invid."'";
    $orderdetails = $conn->query($od);
    $orderrow = $order->fetch_assoc();
    // var_dump($orderrow);
    // exit;
}
else{
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Invoice Number: <?= $invid; ?> </title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body onload="window.print()">
  


<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID:<?= $invid;?> </strong></p>
        </div>
        <div class="col-xl-3 float-end">
          <a onclick="window.print()" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark">
            <i class="fas fa-print text-primary"></i> Print</a>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
              class="far fa-file-pdf text-danger"></i> Export</a>
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?= $orderrow['uname'] ?></span></li>
              <li class="text-muted"></li>
              
              <li class="text-muted"><i class="fas fa-phone"></i> </li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Invoice</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#<?= $invid ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Creation Date: </span><?=  $orderrow['created_at'] ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Status:</span>
                  <?php if($orderrow['status'] == "pe"){ ?>
                  <span class="badge bg-danger text-black fw-bold">
                    Pending
                  </span></li>
                  <?php } ?>
                  <?php if($orderrow['status'] == "pr"){ ?>
                  <span class="badge bg-primary text-black fw-bold">
                    Processing
                  </span></li>
                  <?php } ?>
                  <?php if($orderrow['status'] == "sh"){ ?>
                  <span class="badge bg-info text-black fw-bold">
                    Shipped
                  </span></li>
                  <?php } ?>
                  <?php if($orderrow['status'] == "co"){ ?>
                  <span class="badge bg-success text-black fw-bold">
                    Complete
                  </span></li>
                  <?php } ?>
                  
                  
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Description</th>
                <th scope="col">Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php 
 while($row = $orderdetails->fetch_assoc()){
              ?>
              <tr>
                <th scope="row"><?= $row['product_id'] ?></th>
                <td><?= $row['pname'] ?></td>
                <td>1</td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['price'] ?></td>
              </tr> 
              <?php } ?>
              
              
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <p class="ms-3"><?= $orderrow['comment'];?></p>

          </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span><?= $orderrow['total'] - $orderrow['discount'];?></li>
              <li class="text-muted ms-3"><span class="text-black me-4">Discount</span><?= $orderrow['discount'];?></li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>0</li>
            </ul>
            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;"><?= $orderrow['total'] ;?></span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-12">
            <p>Thank you for your purchase</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>