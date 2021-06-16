<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once('class/DB.class.php');

$db = new db('172.28.64.1', 'dg3', 'password', 'dg3');
