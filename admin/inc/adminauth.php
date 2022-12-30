<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['role']=="2"){

}
else{
    header("location: ../login.php");
}
?>