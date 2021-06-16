<link rel="stylesheet" href="style/style.css">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once('class/DB.class.php');

$db = new db('10.115.255.52', 'dg3', 'password', 'dg3');
