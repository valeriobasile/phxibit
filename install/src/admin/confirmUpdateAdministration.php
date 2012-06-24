<?php include("db.php");?>
<?
$admin_password = md5($_POST["admin_password"]);

$sql = "update admin set admin_password = '".$admin_password."';";
$result = $dbh->query($sql);
$dbh = null;

# log in admin
session_start();
$_SESSION["admin_password"] = $admin_password;

header("location:administration.php?confirm");	
?>
