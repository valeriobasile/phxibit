<?php
$config = parse_ini_file('../config/config.ini');
session_start();
include("login.php");
header( 'Content-Type: text/html; charset=UTF-8' );

//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

mb_internal_encoding( 'UTF-8' );

include("db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title><?=$config['title']?> administration</title>
<link rel="stylesheet" type="text/css" href="style_admin.css" />
</head>
<body>
<div id="menu">
<a href="news.php">news</a>
<a href="works.php">works</a>
<a href="exhibitions.php">exhibitions</a>
<a href="publications.php">publications</a>
<a href="links.php">links</a>
<a href="static.php">static content</a>
<a href="pages.php">active pages</a></div>
<div id="main">

