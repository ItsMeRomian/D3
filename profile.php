<?php
include_once('inc/inc.php');
$account = $db->query('SELECT * FROM users WHERE id = ?', $_GET['id'])->fetchArray();

$friends = $db->query('SELECT * FROM friends WHERE user = ?', $account['id'])->numRows();
$followers = $db->query('SELECT * FROM friends WHERE friend = ?', $account['id'])->numRows();
?>
<h1><?=$account['username']?></h1>

<p><?=$friends?> friends</p>
<p><?=$followers?> followers</p>