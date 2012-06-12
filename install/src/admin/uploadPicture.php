<?php
if (isset($_POST["topic"]) && isset($_POST["work"])){
	$id_topic = $_POST["topic"];
	$id_work = $_POST["work"];

	define("UPLOAD_DIR", "../works/");

	if(isset($_POST['action']) and $_POST['action'] == 'upload'){
	    if(isset($_FILES['user_file'])){
	        $file = $_FILES['user_file'];
	        if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
				move_uploaded_file($file['tmp_name'], UPLOAD_DIR.$id_topic."-".$id_work.".jpg") or die("error uploading file");
        	}
    	}
	}
}
header("location:works.php?topic=".$id_topic);
?> 
