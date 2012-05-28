<?php
$conn = mysql_connect($config['mysql_host'],$config['mysql_user'],$config['mysql_pass']) or die (mysql_error());
mysql_select_db($config['mysql_db'],$conn) or die (mysql_error());
mysql_query("SET CHARACTER SET utf8");
?>
