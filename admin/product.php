<?php require "inc/header.php"; ?>
    </head>
    <body class="sb-nav-fixed">
<?php require "inc/nav.php"; ?>
        <div id="layoutSidenav">
<?php require "inc/sidenav.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
<!--  -->
<button class="btn btn-primary" id="showFormBtn">+</button>
<div id="productFormContainer">
    <form action="product/add.php" method="post" enctype="multipart/form-data">
        <label>Category ID</label>
        <select name="category_id" id="category_id">
            <option value="-1">Select</option>
            <?php
            require "../inc/connection.php";
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
        <input type="text" name="name" required> <br>
        <label>Description</label>
        <textarea name="description" required></textarea> <br>
        <label>Sku</label>
        <input type="text" name="sku" required> <br>
        <label>Image</label>
        <input type="file" name="image" required> <br>
        <label>Price</label>
        <input type="text" name="price" required> <br>
        <label>Quantity</label>
        <input type="number" name="quantity" required> <br>
        <label>Discount(%)</label>
        <input type="text" name="discount" required> <br>
        <label>Hot</label>
        <select name="hot" id="hot">
            <option value="0">Normal</option>
            <option value="1">Hot</option>
        </select>
        <br>
        <input type="submit" name="addproduct" value="Add">
    </form>
</div>
<!--  -->
<div id="tableContainer">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Name</th>
            <th>Desc</th>
            <th>Sku</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Hot</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php
        $q = "select * from products where 1";
        $allp = $conn->query($q);
        $html = "";
        while($row = $allp->fetch_assoc()){
            $html .="<tr>";
            $html .="<td>".$row['id']."</td>";
            $html .="<td>".$row['category_id']."</td>";
            $html .="<td>".$row['subcategory_id']."</td>";
            $html .="<td>".$row['name']."</td>";
            $html .="<td>".$row['description']."</td>";
            $html .="<td>".$row['sku']."</td>";
            $html .="<td><img src='../assets/products/".$row['images']."' width='120px'/></td>";
            $html .="<td>".$row['price']."</td>";
            $html .="<td>".$row['quantity']."</td>";
            $html .="<td>".$row['discount']."</td>";
            $html .="<td>".$row['hot']."</td>";
            $html .="<td>Edit | Delete</td>";
            $html .="</tr>";
        }
        echo $html;
            ?>
        </tbody>
    </table>
</div>
                    </div>
                </main>
 <?php require "inc/footer.php"; ?>
 <script>
    $(document).ready(function () {
$("#productFormContainer").hide();
$("#showFormBtn").click(function(){
    $("#productFormContainer").toggle(200);
});

$("#category_id").change(function(){
    
    $.getJSON("ajax/getsubcat.php",{c:$(this).val()},function(d){
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
