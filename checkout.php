<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

}
else{
    echo "You are not logged in";
    exit;
}
if(isset($_POST['action']) && $_POST['action']=="checkout"){
    require "inc/connection.php";
    // t: total,
    //       d:discount,
    //       p:payment,
    //       trx:trxid,
    //       c:comment,
    $total  = $_POST['t'];
    $dis  = $_POST['d'];
    $payment  = $_POST['p'];
    $trx  = $_POST['trx'];
    $comment  = $_POST['c'];
    $items  = $_POST['items'];
    $user = $_SESSION['userid'];
    // var_dump($items);
    // exit;
    $insertq = "insert into orders values(null,'$user','".$total."','".$dis."','".$comment."','".$payment."','".$trx."','pe',null)";
    $conn->query($insertq);
    if($conn->affected_rows){
        $invoiceid = $conn->insert_id;//invoice id
        foreach ($items as $item) {
            $q = "insert into orderdetails values(null,'".$invoiceid."','".$item['id']."','".$item['price']."','1','',null)";
            $conn->query($q);
        }
        echo json_encode(['success' => true, 'invoiceid'=>$invoiceid]);
    }
    else{
        echo json_encode(['success' => false, 'invoiceid'=>null]); 
    }
        

}

?>