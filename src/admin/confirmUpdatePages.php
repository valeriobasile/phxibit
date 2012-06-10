<?php 
include("db.php");

$biography = $_POST["biography"]=='on'?1:0;
$works = $_POST["works"]=='on'?1:0;
$exhibitions = $_POST["exhibitions"]=='on'?1:0;
$links = $_POST["links"]=='on'?1:0;
$publications = $_POST["publications"]=='on'?1:0;
$contacts = $_POST["contacts"]=='on'?1:0;

$sql = "update page set active = ".$biography." where id='biography';";
$result = $dbh->query($sql);
$sql = "update page set active = ".$works." where id='works';";    
$result = $dbh->query($sql);
$sql = "update page set active = ".$exhibitions." where id='exhibitions';";
$result = $dbh->query($sql);
$sql = "update page set active = ".$publications." where id='publications';";
$result = $dbh->query($sql);
$sql = "update page set active = ".$contacts." where id='contacts';";
$result = $dbh->query($sql);
$sql = "update page set active = ".$links." where id='links';";
echo $sql;
$result = $dbh->query($sql);

header("location:pages.php");	

?>
