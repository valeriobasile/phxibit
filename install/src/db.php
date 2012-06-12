<?php
$config = parse_ini_file('config/config.ini');

if ($config["db_engine"]=="sqlite"){
    try {
        $dbh = new PDO('sqlite:'.$config["sqlite_path"]);
     }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}
elseif ($config["db_engine"]=="mysql"){
    $dbh = new PDO("mysql:host=".$config['mysql_host'].";dbname=".$config['mysql_db']."", $config['mysql_user'], $config['mysql_pass']);
}
?>
