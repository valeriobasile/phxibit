<?php
// checks.php
require_once("functions.php");

function check_dir($dir){
	return (file_exists($dir) && is_writable($dir)) || mkdir($dir, 0777, true);
}

function check_file($file){
    return (file_exists($file) && is_writable($file)) || touch($file);
}

function copy_dir($src, $dir){
    try {
        return full_copy($src, $dir);
    }
    catch (Exception $e){
        return False;
    }
}

function check_sqlite($sqlite_path) {
    try {
        $dbh = new PDO('sqlite:'.$sqlite_path);
        return create_sqlite_schema($dbh, "create_schema_sqlite.sql");
    }
    catch (Exception $e){
        return False;
    }
}


function make_checks($post){
    $errors = array();
    
    # create website image directory
    if (!copy_dir("src/img", "../".$post["img_dir"])){
        $errors[] = "Cannot create image directory";
    }
    
    # create image directories
    if (!copy_dir("src/".$post["publications_dir"], "../".$post["publications_dir"])){
        $errors[] = "Cannot copy publications directory";
    }
    if (!copy_dir("src/".$post["works_dir"], "../".$post["works_dir"])){
        $errors[] = "Cannot copy works directory";
    }
    if (!copy_dir("src/".$post["exhibitions_dir"], "../".$post["exhibitions_dir"])){
        $errors[] = "Cannot copy exhibitions directory";
    }
    
    # copy static files directory
    if (!copy_dir("src/static", "../".$post["static_dir"])){
        $errors[] = "Cannot create static directory";
    }

    # SQLite database
    if ($post["db_engine"]=="sqlite"){
        if (!check_dir("../db")){
            $errors[] = "database directory is not writable";
        }
        if (!(check_sqlite("../".$post["sqlite_path"]))){
            $errors[] = "Cannot connect to SQLite database ".$post["sqlite_path"];    
        }
        #$dbh = new PDO('sqlite:'.$config["sqlite_path"]);
        #if (!create_sqlite_schema($dbh, "create_schema_sqlite.sql")){
        #    $errors[] = "Cannot create SQLite database";            
        #}
    }

    # MySQL database
    elseif ($post["db_engine"]=="mysql"){
        $host = $post["mysql_host"];
        $user = $post["mysql_user"];
        $pass = $post["mysql_pass"];
        $dbname = $post["mysql_db"];
        try {
            $dbh = new PDO("mysql:host=".$post['mysql_host'].";dbname=".$post['mysql_db']."", $post['mysql_user'], $post['mysql_pass']);            
            if (!create_mysql_schema($dbh, "create_schema.sql")){
                $errors[] = "Cannot create MySQL database";            
            }
        }
        catch(PDOException $e) {
             $errors[] = "Cannot connect to MySQL database ".$post["mysql_db"]." on host ".$post["mysql_host"].": ".$e->getMessage();
        }

    }

    # PHP files (copy)
    $d = dir("src");
	while ( FALSE !== ( $entry = $d->read() ) ) {
		if ( $entry == '.' || $entry == '..' ) {
			continue;
		}
		$Entry = "src/" . $entry; 
		if (!is_dir( $Entry )) {
    		if (!copy( $Entry, '../' . $entry )){
    		    $errors[] = "error copying file ".$Entry;
    		}
		}
    }
    
    # config directory
    if (!check_dir("../config")){
        $errors[] = "configuration directory is not writable";
    }
    
    if (!write_ini_file($post, "../config/config.ini", $has_sections=FALSE)){
        $errors[] = "cannot write configuration file";    
    }
    
    
    # copy admin directory
    if (!copy_dir("src/admin", "../admin")){
        $errors[] = "Cannot create admin directory";
    }
    
    # PHP files (chmod)
    $d = dir("../");
	while ( FALSE !== ( $entry = $d->read() ) ) {
		if ( $entry == '.' || $entry == '..' ) {
			continue;
		}
		if (substr('../' . $entry, -4) == '.php' && !chmod('../' . $entry, 0755)){
		    $errors[] = "error copying file ".$Entry;
		}
    }
    $d = dir("../admin/");
	while ( FALSE !== ( $entry = $d->read() ) ) {
		if ( $entry == '.' || $entry == '..' ) {
			continue;
		}
		if (substr('../admin/' . $entry, -4) == '.php' && !chmod('../admin/' . $entry, 0755)){
		    $errors[] = "error in chmod file ".$entry;
		}
    }
    
    return $errors;
}

?>
