<?php
include_once("inc/inc.php");
$_SESSION['auth'] = null;
session_destroy();
header("Location: http://localhost/D3/login?loggedout=1");
