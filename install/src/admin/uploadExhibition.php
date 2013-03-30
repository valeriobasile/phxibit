<?php
$config = parse_ini_file('../config/config.ini');

if (isset($_POST["exhibition"])){
	$id_exhibition = $_POST["exhibition"];
	define("UPLOAD_DIR", "../".$config["exhibitions_dir"]."/");
    
	if(isset($_POST['action']) and $_POST['action'] == 'upload'){
	    if(isset($_FILES['user_file'])){
	        $file = $_FILES['user_file'];
	        if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
				move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$id_exhibition.".jpg") or die("error uploading file");
        	}
    	}
	}
}

header("location:exhibitions.php");
?> 
