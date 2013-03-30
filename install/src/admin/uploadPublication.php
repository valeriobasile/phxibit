<?php
$config = parse_ini_file('../config/config.ini');

if (isset($_POST["category"]) && isset($_POST["publication"])){
	$id_category = $_POST["category"];
	$id_publication = $_POST["publication"];

	define("UPLOAD_DIR", "../".$config["publications_dir"]."/");
    
	if(isset($_POST['action']) and $_POST['action'] == 'upload'){
	    if(isset($_FILES['user_file'])){
	        $file = $_FILES['user_file'];
	        if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
				move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$id_category."-".$id_publication.".jpg") or die("error uploading file");
        	}
    	}
	}
}
header("location:publications.php?category=".$id_category);
?> 
