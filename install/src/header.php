<?php
$config = parse_ini_file('config/config.ini');
include("db.php");
header( 'Content-Type: text/html; charset=UTF-8' );
mb_internal_encoding( 'UTF-8' );

$sql = "select id, active from page;";
$result = $dbh->query($sql);
$show = array();
while ($row = $result->fetch()){
	$show[$row["id"]] = $row["active"];
}
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
		    <?if ($show['biography']){?>
		    <a href="biography.php">biography</a>
            <?}?> 
		    <?if ($show['works']){?>
		    <a href="works.php">works</a>
            <?}?> 
		    <?if ($show['exhibitions']){?>
		    <a href="exhibitions.php">exhibitions</a>
            <?}?> 
		    <?if ($show['publications']){?>
		    <a href="publications.php">publications</a>
            <?}?> 
		    <?if ($show['links']){?>
		    <a href="links.php">links</a>
            <?}?> 
		    <?if ($show['contacts']){?>
		    <a href="contact.php">contact</a>
            <?}?> 
		</div>
	</div>
	<div id="content">


