<?php
$config = parse_ini_file('../config/config.ini');

if ($config["db_engine"]=="sqlite"){
    $conn = new PDO('sqlite:'.$config["sqlite_path"]);
}
elseif ($config["db_engine"]=="mysql"){
    $dbh = new PDO("mysql:host=".$config['mysql_host'].";dbname=".$config['mysql_db']."", $config['mysql_user'], $config['mysql_pass']);
}
?>
