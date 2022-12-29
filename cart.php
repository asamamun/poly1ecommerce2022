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

      </div>
      <div class="col-12 col-sm-4 p-3 proceed form">
            <div class="row m-0">
              <div class="col-sm-8 p-0">
                <h6>Subtotal</h6>
              </div>
              <div class="col-sm-4 p-0">
                <p id="subtotal"></p>
              </div>
            </div>
            <div class="row m-0">
              <div class="col-sm-8 p-0 ">
                <h6>Tax</h6>
              </div>
              <div class="col-sm-4 p-0">
                <p id="tax"></p>
              </div>
            </div>
            
            <div class="row mx-0 mb-2">
              <div class="col-sm-4 p-0 d-inline">
                <h6>Discount</h6>
              </div>
              <div class="col-sm-8 p-0">
                <input type="text" id="discount" class="form-control" value="0">
              </div>
            </div>
            <hr>
            <div class="row mx-0 mb-2">
              <div class="col-sm-8 p-0 d-inline">
                <h5>Total</h5>
              </div>
              <div class="col-sm-4 p-0">
                <p id="total"></p>
              </div>
            </div>

            <div class="row mx-0 mb-2">
              <div class="col-sm-4 p-0 d-inline">
                <h6>Payment</h6>
              </div>
              <div class="col-sm-8 p-0">
                <select name="payment" id="payment" class="form-control">
                  <option value="-1">Select</option>
                  <option value="cash">Cash</option>
                  <option value="bkash">bKash</option>
                  <option value="nogod">Nogod</option>
                  <option value="cod">Cash On Delivery</option>
                </select>
              </div>
            </div>
            <div class="row mx-0 mb-2">
              <div class="col-sm-4 p-0 d-inline">
                <h6>TrxID</h6>
              </div>
              <div class="col-sm-8 p-0">
                <input type="text" id="trxid" class="form-control">
              </div>
            </div>
            <div class="row mx-0 mb-2">
              <div class="col-sm-4 p-0 d-inline">
                <h6>Comment</h6>
              </div>
              <div class="col-sm-8 p-0">
                <textarea name="comment" id="comment" class="form-control"></textarea>
              </div>
            </div>
            <button id="btn-checkout" class="btn btn-outline-danger">Checkout</button>
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

          //discount start
          $("#discount").blur(function(){
        // alert(5)
        let amount = Number($(this).val());
        $("#total").html(Number($("#total").html()) - amount);
      });
      //discount end
      //
//checkout
$("#btn-checkout").click(function(){
        let items = cart.items;
        let discount = $("#discount").val();
        let total = Number($("#total").html());
        let payment = $("#payment").val();
        let trxid = $("#trxid").val();
        // alert(trxid.length);
        let comment = $("#comment").val();
        if(payment == "-1"){ alert("pls select payment method"); return;}
        if(payment =="bkash" || payment == "nogod"){
          if(trxid.length == 0){ alert("Please provide transaction id if you select bkash or nogod"); return;}
        }

        //ajax post in jquery start
        $.post("checkout.php",{
          action:"checkout",
          t: total,
          d:discount,
          p:payment,
          trx:trxid,
          c:comment,
          items:cart.items,
        },function(d){
          
          d = JSON.parse(d)
          //console.log(d)
  if(d.success){
    alert("Your order has been received. Order Id : " + d.invoiceid);
    cart.emptyCart();
    location.href = "index.php";;
  }
        //ajax post in jquery end
      }); 
      }); 

      //

});
    </script>
    <!-- footer end -->
</body>
</html>