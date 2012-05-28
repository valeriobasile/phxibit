<?php
$config = parse_ini_file('config/config.ini');
include("mysql.php");
header( 'Content-Type: text/html; charset=UTF-8' );
mb_internal_encoding( 'UTF-8' );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title><?=$config['title']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/phxibit.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="header">
		<div id="logo">
		<a href="home.php">
		<img src="<?=$config['img_dir']?>/<?=$config['logo_file']?>">
		</a>
		</div>
		<div id="navigation">
		    <a href="biography.php">biography</a>
		    <a href="works.php">works</a>
		    <a href="exhibitions.php">exhibitions</a>
		    <a href="publications.php">publications</a>
		    <a href="links.php">links</a>
		    <a href="contact.php">contact</a>
		</div>
	</div>
	<div id="content">


