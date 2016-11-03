<?php
session_start();
$_SESSION["XuserID"] = "";
$_SESSION["XuserU"] = "";
$_SESSION["XuserN"] = "";
$_SESSION["XuserP"] = "";
session_destroy();
header("location:login.php");
?>
