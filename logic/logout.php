<?php
session_start();
if(isset($_GET['logout'])){
   // var_dump($_GET['logout']);\
   unset($_SESSION['ulogovan']);
   header("Location:../login.php");
}
else{
    http_response_code(404);
} ?>