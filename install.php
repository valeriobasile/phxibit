<?php
function create_sqlite_schema($dbh){
    $sql = file_get_contents("create_schema_sqlite.sql");
    foreach (explode(";", $sql) as $statement){
        $dbh->exec($statement);
    }
}

/* the following $temp_* variables will be read from 
 * the installation web interface
 */ 
$temp_sqlite = "src/db/phxibit.sq3";

echo ("creating sqlite database...");
$dbh = new PDO('sqlite:'.$temp_sqlite);
create_sqlite_schema($dbh);

echo ("installation complete");
?>
