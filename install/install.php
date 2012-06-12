<?php
require_once("functions.php");
require_once("defaults.php");
require_once("checks.php");

# field values (from POST or from defaults.php)
$values = array();

if (isset($_POST["submit"])){
    $errors = make_checks($_POST);
    if ($errors) {
        display_errors($errors);
        make_clean($_POST);
    }
    else {
        header("location: complete.php");
    }
    $values = $_POST;
}
else {
    $values = $defaults;    
}

?>

<html>
<head>
<title>PHXibit installation procedure</title>
</head>
<body>
<form action="install.php" method="post">

<h1>General</h1>
<?
make_input($values, "title", "Title of the website");
make_input($values, "artist", "Name of the artist");
make_input($values, "email", "E-mail");
?>

<h1>Images directories</h1>
<?
make_input($values, "img_dir", "Website images directory");
make_input($values, "logo_file", "Header image file");
make_input($values, "portrait_file", "Portrait image file");
make_input($values, "icon_prev", "\"Previous\" icon file");
make_input($values, "icon_next", "\"Next\" icon file");
make_input($values, "publications_dir", "\"Publication\" images directory");
make_input($values, "works_dir", "\"Work\" images directory");
make_input($values, "exhibitions_dir", "\"Exhibition\" images directory");
?>


<h1>Navigation</h1>
<?
make_input($values, "text_prev", "\"Previous\" text");
make_input($values, "text_next", "\"Next\" text");
?>

<h1>Static files</h1>
<?
make_input($values, "static_dir", "Directory for static files");
make_input($values, "biography_file", "Biography HTML file");
make_input($values, "contact_file", "Contact HTML file");
make_input($values, "footer_file", "Footer HTML file");
?>

<h1>Database</h1>
<?
make_input($values, "db_engine", "Database engine (\"sqlite\" or \"mysql\")");
?>

<h1>SQLite</h1>
<?
make_input($values, "sqlite_path", "Path to the SQLite database file");
?>

<h1>MySQL</h1>
<?
make_input($values, "mysql_host", "MySQL host");
make_input($values, "mysql_user", "MySQL username");
make_input($values, "mysql_pass", "MySQL password", $password=True);
make_input($values, "mysql_db", "MySQL database");
?>

<h1>Administration</h1>
<label for="admin_password">Admin password</label>
<input name="admin_password" id="admin_password" type="password" />
<br/>

<input name="submit" type="hidden" />
<input type="submit" />
</form>
</body>
</html>
