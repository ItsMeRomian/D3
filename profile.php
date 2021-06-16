<?php
include_once('inc/inc.php');
$account = $db->query('SELECT * FROM users WHERE id = ?', $_GET['id'])->fetchArray();
?>
<h1><?=$account['username']?></h1>