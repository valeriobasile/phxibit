<?php 
$config = parse_ini_file('config/config.ini');
include("db.php");

$sql = "select background_color, text_color, link_color, font from style;";
$result = $dbh->query($sql);
$row = $result->fetch();

$back = $row["background_color"];
$text = $row["text_color"];
$link = $row["link_color"];
$font = $row["font"];

header("Content-type: text/css");
?>

@charset "iso-8859-1";

#header {
    margin-top: 0px;
    margin-left: 15%;
    margin-right: 15%;
    border-bottom: 1px #58291e solid;
    padding-bottom: 0.5em;
}

#content {
    margin-left: 15%;
    margin-right: 15%;
    padding-top: 2em;
}

#portrait {
    width: 49%;
    float:left;
    margin-bottom: 1em;
}

#biography {
    width: 49%;
    float:right;
}

#works_menu {
    width: 20%;
    float: left;
}

#works_menu ul{
    margin-left: 1em;
    padding-left: 0px;
    list-style-type: square;
}

#work {
    width: 60%;
    margin-right: 20%;
    text-align:center;
    float: right;
}

#works_navigation {
    font-size: small;
    clear: both;
    text-align: center;
    padding-top: 2em;
}

#works_navigation a{
    text-decoration: none;
    font-weight: bold;
}

#works_navigation_topic {
    font-style: italic;
    padding-bottom: 1em;
}

#works_navigation_title {
    font-weight: bold;
    padding-top: 1em;
}

#works_navigation_description {
    color: #a7b5c1;
}


#exhibitions_navigation_title {
    font-weight: bold;
}

#exhibitions_navigation_description {
    color: #a7b5c1;
}

#link_url {
    color: #a7b5c1;
    width: 18%;
    float: left;
    clear: both;
    display: block;
    text-align: right;
    margin-right: 2%;
}

#link_description {
    font-weight: bold;
    width:60%;
    margin-left:20%;
    display: block;
}

#contact ul{
    margin-left: 1em;
    padding-left: 0px;
    list-style-type: none;
}

#contact li{
    margin-top: 1em;
}

#footer {
    background-color: #58291e;
    font-size: small;
    color: #a7b5c1;
    margin-top:2em;
    clear: both;
    padding: 0.2em;
}

#footer a {
    color: #ff6600;
}

body {
    font-family: '<?=$font?>';
    background-color: #<?=$back?>;
    color: #<?=$text?>;
}

a {
    color: #<?=$link?>;
}

a:hover {
    text-decoration: none;
    color: #ff6600;
}

