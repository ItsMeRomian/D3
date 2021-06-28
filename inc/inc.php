<link rel="stylesheet" href="style/style.css">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['auth'])) {
    if ($_SERVER['REQUEST_URI'] !== "/D3/login" or $_SERVER['REQUEST_URI'] !== "/D3/login.php") {

        //Later dit uncommenten, voor nu gewoon error message.
        //header('Location: login');

        echo "<span style='color: red'>Je bent niet ingelogd</span>";
    }
}
include_once('templates/post.template.php');

include_once('class/DB.class.php');
$db = new db('dev.dyna.host', 'dg3', 'password', 'dg3');

include_once('class/User.class.php');

include_once('class/Post.class.php');
$posts = new Post($db);

include_once('class/Auth.class.php');
