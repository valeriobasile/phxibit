<?
$config = parse_ini_file('../config/config.ini');

$biography = $_POST["biography"];
$contact = $_POST["contact"];
$footer = $_POST["footer"];

file_put_contents("../".$config["static_dir"]."/".$config["biography_file"], $biography) or die ("cannot write biography file") ;
file_put_contents("../".$config["static_dir"]."/".$config["contact_file"], $contact) or die ("cannot write contact file") ;
file_put_contents("../".$config["static_dir"]."/".$config["footer_file"], $footer) or die ("cannot write footer file") ;

header("location:static.php");	

?>
