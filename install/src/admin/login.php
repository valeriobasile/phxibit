<?php
$first_try = false;

# if just logged in, set PHP session
if (isset($_POST["admin_password"])){
    $_SESSION["admin_password"] = md5($_POST["admin_password"]);
    $first_try = True;
}

# if not logged in, show login form
if (!isset($_SESSION["admin_password"]) || $config["admin_password"] != $_SESSION["admin_password"]) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title><?=$config['title']?> administration</title>
<link rel="stylesheet" type="text/css" href="style_admin.css" />
</head>
<body>
<?if ($first_try){?>
access denied<br/>
<?}?>
<form action = "<?=$_SERVER['REQUEST_URI']?>" method="post">
Admin password <br/>
<input name="admin_password" type="password"/>
</form>
</body>
</html>
<?
die;
}
?>

