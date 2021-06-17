<?php
include_once('inc/inc.php');
$user = new User($_GET['id'], $db);
$userObject = $user->getUserObject();
$post = $db->query('SELECT * FROM posts WHERE id = ?', $userObject['id'])->fetchArray();
$likes = $db->query('SELECT * FROM likes WHERE post = ?', $post['id'])->numRows();
?>
<h1><?=$post['name']?></h1>
<h2>By <a href="profile.php?id=<?=$account['id']?>"><?=$account['username']?></a></h2>
<p><?=$post['body']?></p>
<p><?=$likes?> Likes</p>