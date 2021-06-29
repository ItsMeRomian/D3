<?php
include_once("inc/inc.php");
$auth = new Auth();
$auth->logout();
header("Location: http://localhost/D3/login?loggedout=1");
