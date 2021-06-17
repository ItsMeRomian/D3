<link rel="stylesheet" href="style/style.css">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once('class/DB.class.php');
include_once('class/User.class.php');
include_once('class/Post.class.php');

$db = new db('34.76.21.36', 'dg3', 'password', 'dg3');
