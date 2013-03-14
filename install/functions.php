<?php
// functions.php
function deleteDir($dir) 
{ 
   if (substr($dir, strlen($dir)-1, 1) != '/') 
       $dir .= '/'; 

   if ($handle = opendir($dir)) 
   { 
       while ($obj = readdir($handle)) 
       { 
           if ($obj != '.' && $obj != '..') 
           { 
               if (is_dir($dir.$obj)) 
               { 
                   if (!deleteDir($dir.$obj)) 
                       return false; 
               } 
               elseif (is_file($dir.$obj)) 
               { 
                   if (!unlink($dir.$obj)) 
                       return false; 
               } 
           } 
       } 

       closedir($handle); 

       if (!@rmdir($dir)) 
           return false; 
       return true; 
   } 
   return false; 
}  


function create_sqlite_schema($dbh, $schema_file){
    try{
        $sql = file_get_contents($schema_file);
        foreach (explode(";", $sql) as $statement){
			$sth = $dbh->prepare($statement);
			if (!$sth) {
				die ($statement);
			}
			$sth->execute();
        }
        return True;
    }
    catch (Exception $e){
        return False;
    }
}

function display_errors($errors){
    echo "<pre>";
    foreach ($errors as $error){
        echo "$error\n";
    }
    echo "</pre>";
}

function make_input($values, $field, $label, $password=False){
    $value = $values[$field];
    echo "<label for=\"$field\">$label</label>";
    echo "<input name=\"$field\" id=\"$field\" value=\"$value\" ";
    if ($password){
        echo "type=\"password\" ";
    }
    else{
        echo "type=\"text\" ";
    }
    echo ">";
    echo "<br />";
}

function make_clean($post){
    error_reporting(E_ERROR | E_PARSE);

    if (file_exists("../".$post["img_dir"])) {
        deleteDir("../".$post["img_dir"]);
    }
    if (file_exists("../".$post["publications_dir"])) {
        deleteDir("../".$post["publications_dir"]);
    }
    if (file_exists("../".$post["works_dir"])) {
        deleteDir("../".$post["works_dir"]);
    }
    if (file_exists("../".$post["exhibitions_dir"])) {
        deleteDir("../".$post["exhibitions_dir"]);
    }
    if (file_exists("../".$post["static_dir"])) {
        deleteDir("../".$post["static_dir"]);
    }
    if (file_exists("../db")) {
        deleteDir("../db");
    }
    
    # MySQL database
    try {
        $dbh = new PDO("mysql:host=".$post['mysql_host'].";dbname=".$post['mysql_db']."", $post['mysql_user'], $post['mysql_pass']);
        $sql = "drop database ".$post['mysql_db'].";";
        $result = $dbh->query($sql);
    }
    catch(PDOException $e) {
         ;
    }

    unlink("../biography.php");
    unlink("../contact.php");
    unlink("../db.php");
    unlink("../exhibitions.php");
    unlink("../footer.php");
    unlink("../header.php");
    unlink("../home.php");
    unlink("../links.php");
    unlink("../publications.php");
    unlink("../works.php");
    
    if (file_exists("../config")) {
        deleteDir("../config");
    }
    
    error_reporting(E_ALL);

}

function write_ini_file($assoc_arr, $path, $has_sections=FALSE) {
	$content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) {
			if ($key == 'admin_password')
				$elem = md5($elem);
            $content .= "[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                    } 
                } 
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem2."\"\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
			if ($key == 'admin_password')
				$elem = md5($elem);
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key." = \n"; 
            else $content .= $key." = \"".$elem."\"\n"; 
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
        return false; 
    } 
    if (!fwrite($handle, $content)) { 
        return false; 
    } 
    fclose($handle); 
    return true; 
}



function full_copy( $source, $target ) {
    if (!file_exists($target)){
	    mkdir($target);
	}
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}
 
		$d->close();
	}else {
		copy( $source, $target );
	}
	return True;
}
?>
