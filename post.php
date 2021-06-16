<?php
include_once('inc/inc.php');
$post = $db->query('SELECT * FROM posts WHERE id = ?', $_GET['id'])->fetchArray();
$account = $db->query('SELECT * FROM users WHERE id = ?', $post['userId'])->fetchArray();
$likes = $db->query('SELECT * FROM likes WHERE post = ?', $post['id'])->numRows();
?>
<h1><?=$post['name']?></h1>
<h2>By <a href="profile.php?id=<?=$account['id']?>"><?=$account['username']?></a></h2>
<p><?=$post['body']?></p>
<p><?=$likes?> Likes</p>