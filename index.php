<?php require "inc/connection.php" ?>
<?php require "inc/header.php"; ?>

</head>
<body>
    <div class="container">
<!-- menu start -->
<?php include "inc/navbar.php"; ?>
<!-- menu end -->
<!-- carousel start -->
<?php include "inc/carousel.php"; ?>
<!-- carousel end -->
<!-- owl carousel start -->

<!-- owl carousel end -->
<!-- categories start -->
<?php
$cq = "select * from categories where 1";
$cqr = $conn->query($cq);
while ( $row= $cqr->fetch_assoc()) {
    echo "<a href='product.php?cat=".$row['id']."'>".$row['name']."</a> ";
}
?>
<!-- categories end -->
<!-- product start -->
<div class="row">


<?php
$pq = "select * from products where hot='1' order by created_at desc";
$pqr = $conn->query($pq);
$p = "";
while($row = $pqr->fetch_assoc()){

$p .= '<div class="card mt-2 col-md-2 d-flex align-items-stretch"><img src="assets/products/'.$row['images'].'" class="card-img-top" alt="..."><div class="card-body"><a href="product.php?id='.$row["id"].'"><h3 class="pname">'.$row['name'].'</h3></a><p class="card-text">'.$row['description'].'</p><p>'.$row['price'].'</p><p><a class="addCartBtn" data-pid="'.$row['id'].'" data-pprice="'.$row['price'].'" href="javascript:void(0)"><i class="bi bi-bag"></i></a></p></div></div>';
}
echo $p;
?>
</div>
<!-- product end -->
    </div>
    <!-- footer start -->
    <?php include "inc/footer.php"; ?>
    <script>
$(document).ready(function () {
    const cart = new Cart();
    $("#bcart").html(cart.totalItems());
    $(".addCartBtn").click(function(){
        $t = $(this);
       let pid = $t.data("pid");
       let pprice = $t.data("pprice");
       let name = $t.parent().parent().find('.pname').html();
       let img = $t.parent().parent().parent().find('.card-img-top').attr('src');
    //    alert(img)
    //    alert(name);
    //    alert(pid + ": " + pprice);
       cart.addItem({ name: name, price: pprice, id:pid, image:img  });
       $("#bcart").html(cart.totalItems());
// console.log(cart.totalItems());
alert("Product "+ name + " has been added to cart");
    });
});
    </script>
    <!-- footer end -->
</body>
</html>