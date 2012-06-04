<?php 
include("mysql.php");

$biography = $_POST["biography"]=='on'?1:0;
$works = $_POST["works"]=='on'?1:0;
$exhibitions = $_POST["exhibitions"]=='on'?1:0;
$links = $_POST["links"]=='on'?1:0;
$publications = $_POST["publications"]=='on'?1:0;
$contacts = $_POST["contacts"]=='on'?1:0;

$sql = "update page set active = ".$biography." where id='biography';";
$result = mysql_query($sql) or die (mysql_error());
$sql = "update page set active = ".$works." where id='works';";    
$result = mysql_query($sql) or die (mysql_error());
$sql = "update page set active = ".$exhibitions." where id='exhibitions';";
$result = mysql_query($sql) or die (mysql_error());
$sql = "update page set active = ".$publications." where id='publications';";
$result = mysql_query($sql) or die (mysql_error());
$sql = "update page set active = ".$contacts." where id='contacts';";
$result = mysql_query($sql) or die (mysql_error());
$sql = "update page set active = ".$links." where id='links';";
echo $sql;
$result = mysql_query($sql) or die (mysql_error());

header("location:pages.php");	

?>
