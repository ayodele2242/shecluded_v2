<?php
require "functions.php";
if(!isset($_SESSION['email'])){
    redirect('../auth');
}else{ 


$name = $_SESSION['name'];
$role = $_SESSION['role'];	
$email = $_SESSION['email'];
}


?>