<?php
# connessione al database
$host = "127.0.0.1";   
$user = "basic";
$pass = "darkaelf";
$dbname = "phxibit";

$connessione = mysql_connect($host,$user,$pass) or die (mysql_error());
$selezione = mysql_select_db($dbname,$connessione) or die (mysql_error());
mysql_query("SET CHARACTER SET utf8");
?>
