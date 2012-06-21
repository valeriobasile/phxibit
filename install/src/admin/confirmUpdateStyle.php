<?php
include("db.php");

$config = parse_ini_file('../config/config.ini');
define("UPLOAD_DIR", '../'.$config['img_dir']);

if(isset($_FILES['logo'])){
    $file = $_FILES['logo'];
    if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
		move_uploaded_file($file['tmp_name'], UPLOAD_DIR.'/'.$config['logo_file']) or die("error uploading file");
	}
}

if(isset($_FILES['portrait'])){
    $file = $_FILES['portrait'];
    if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
		move_uploaded_file($file['tmp_name'], UPLOAD_DIR.'/'.$config['portrait_file']) or die("error uploading file");
	}
}

if(isset($_FILES['icon_prev'])){
    $file = $_FILES['icon_prev'];
    if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
		move_uploaded_file($file['tmp_name'], UPLOAD_DIR.'/'.$config['icon_prev']) or die("error uploading file");
	}
}

if(isset($_FILES['icon_next'])){
    $file = $_FILES['icon_next'];
    if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])){
		move_uploaded_file($file['tmp_name'], UPLOAD_DIR.'/'.$config['icon_next']) or die("error uploading file");
	}
}

$background_color = $_POST["background_color"];
$text_color = $_POST["text_color"];
$link_color = $_POST["link_color"];
$font = $_POST["font"];

$sql = "update style set background_color = '".$background_color."', text_color = '".$text_color."', link_color = '".$link_color."', font = '".$font."';";
$result = $dbh->query($sql);
$dbh = null;

header("location:style.php");
?> 
