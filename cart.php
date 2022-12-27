<?php require "inc/connection.php" ?>
<?php require "inc/header.php"; ?>
<style>
    input[type="number"]{
        width:50px
    }
</style>
</head>
<body>
    <div class="container">
<!-- menu start -->
<?php include "inc/navbar.php"; ?>
<!-- menu end -->

<!-- cart start -->
<main id="cart" style="max-width:calc(100% - 20px)">
  <div class="back"><a href="index.php">&#11178; shop</a></div>
  <h1>Your Cart</h1>
  <div class="container-fluid">
    <div class="row align-items-start">
      <div class="col-12 col-sm-8 items" id="itemContainer">
        <!--1-->
        <div class="cartItem row align-items-start">
          <div class="col-3 mb-2">
            <img class="w-100" src="https://badux.co/smc/codepen/birdcage-posters.jpg" alt="art image">
          </div>
          <div class="col-5 mb-2">
            <h6 class="">Dark Art 1</h6>
            <p class="pl-1 mb-0">20 x 24</p>
            <p class="pl-1 mb-0">Matte Print</p>
          </div>
          <div class="col-2">
            <p class="cartItemQuantity p-1 text-center">1</p>
          </div>
          <div class="col-2">
            <p id="cartItem1Price">$66</p>
          </div>
        </div>
        <hr>
        <!--2-->
        <!-- <div class="cartItem row align-items-start">
          <div class="col-3 mb-2">
            <img class="w-100" src="https://badux.co/smc/codepen/birdcage-posters.jpg" alt="art image">
          </div>
          <div class="col-5 mb-2">
            <h6 class="">Dark Art 2</h6>
            <p class="pl-1 mb-0">20 x 24</p>
            <p class="pl-1 mb-0">Matte Print</p>
          </div>
          <div class="col-2">
            <p class="cartItemQuantity p-1 text-center">1</p>
          </div>
          <div class="col-2">
            <p id="cartItem1Price">$66</p>
          </div>
        </div>
        <hr> -->
      </div>
      <div class="col-12 col-sm-4 p-3 proceed form">
        <div class="row m-0">
          <div class="col-sm-8 p-0">
            <h6>Subtotal</h6>
          </div>
          <div class="col-sm-4 p-0">
            <p id="subtotal">$132.00</p>
          </div>
        </div>
        <div class="row m-0">
          <div class="col-sm-8 p-0 ">
            <h6>Tax</h6>
          </div>
          <div class="col-sm-4 p-0">
            <p id="tax">$6.40</p>
          </div>
        </div>
        <hr>
        <div class="row mx-0 mb-2">
          <div class="col-sm-8 p-0 d-inline">
            <h5>Total</h5>
          </div>
          <div class="col-sm-4 p-0">
            <p id="total">$138.40</p>
          </div>
        </div>
        <a href="#"><button class="btn btn-outline-warning" id="btn-checkout" class="shopnow"><span>Checkout</span></button></a>
      </div>
    </div>
  </div>
  </div>
</main>
<!-- cart end -->
    </div>
    <!-- footer start -->
    <?php include "inc/footer.php"; ?>
    <script>
$(document).ready(function () {
    const cart = new Cart();
    let items = cart.getItems();
    let html = ``;
    let subtotal = 0;
    let tax = 0.05;
    let total = 0;
    // console.log(items);
    items.forEach(i => {
        subtotal += Number(i.price);
        html += `<div class="cartItem row align-items-start">
          <div class="col-3 mb-2">
            <img class="w-100" src="${i.image}" alt="art image">
          </div>
          <div class="col-3 mb-2">
            <h6 class="">${i.name}</h6>            
          </div>
          <div class="col-2">            
            <input type="number" value="1" class="quantity" size="4"/>            
          </div>
          <div class="col-2">
            <p id="cartItem1Price">${i.price}</p>
          </div>
          <div class="col-2">
            <a href='javascript:void(0)' class="removeItem" data-item='${i.id}'><i class="bi bi-trash"></i></a>
          </div>
        </div>
        <hr>`;
    });
    total = subtotal + subtotal * tax;
    document.getElementById("itemContainer").innerHTML = html;
    document.getElementById("subtotal").innerHTML = subtotal;
    document.getElementById("tax").innerHTML = tax;
    document.getElementById("total").innerHTML = total;

    $(".removeItem").click(function(){
        console.log($(this).data("item"));
        // return;
        if(confirm("Are you sure you want to remove")){
            cart.removeItem($(this).data("item"));
            location.reload();
        }
        
    })

});
    </script>
    <!-- footer end -->
</body>
</html>