<?php require "inc/header.php"; ?>
    </head>
    <body class="sb-nav-fixed">
<?php require "inc/nav.php"; ?>
        <div id="layoutSidenav">
<?php require "inc/sidenav.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
<div id="tableContainer">
    <p> <strong>Legend : </strong>
        <span class="smallbox bg-danger"></span> = Pending , 
        <span class="smallbox bg-primary"></span> = Processing , 
        <span class="smallbox bg-info"></span> = Shipped , 
        <span class="smallbox bg-success"></span> = Complete , 
    </p>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Comment</th>
            <th>Payment</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Products</th>
            <th>Order Time</th>            
            <th>Action</th>
        </tr>
        <tbody>
            <?php
            require "../inc/connection.php";
        $q = "select orders.*, users.username as username from orders,users where orders.user_id=users.id order by orders.created_at desc";
        $allp = $conn->query($q);
        $html = "";
        while($row = $allp->fetch_assoc()){
            $html .="<tr>";
            $html .="<td>".$row['id']."</td>";
            $html .="<td>".$row['username']."</td>";
            $html .="<td>".$row['total']."</td>";
            $html .="<td>".$row['discount']."</td>";
            $html .="<td>".$row['comment']."</td>";
            $html .="<td>".$row['payment']."</td>";
            $html .="<td>".$row['trxid']."</td>";
            $boxcolor = null;
            if($row['status'] == "pe"){$boxcolor = "bg-danger";}
            if($row['status'] == "pr"){$boxcolor = "bg-primary";}
            if($row['status'] == "sh"){$boxcolor = "bg-info";}
            if($row['status'] == "co"){$boxcolor = "bg-success";}
            $html .="<td><span class='smallbox ".$boxcolor."'> </span>".$row['status']."</td>";
            $html .="<td>all products list</td>";
            $html .="<td>".$row['created_at']."</td>";            
            $html .="<td><a target='_blank' href='orderstatus.php?id=".$row['id']."'>Edit</a> | <a target='_blank' href='orderdetails.php?id=".$row['id']."'>View</a></td>";
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

    });
 </script>              
    </body>
</html>
