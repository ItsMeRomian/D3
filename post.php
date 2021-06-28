<?php
include_once('inc/inc.php');

//Get the post
$post = $posts->getPost($_GET['id']);

//Get the userobject of the user who posted
$user = new User($post['userId'], $db);
$userObject = $user->getUserObject();

//Get the likes
$likes = $db->query('SELECT * FROM likes WHERE post = ?', $post['id'])->numRows();
?>
<h1><?= $post['name'] ?></h1>
<h2>By <a href="profile.php?id=<?= $userObject['id'] ?>"><?= $userObject['username'] ?></a></h2>
<p><?= $post['body'] ?></p>
<p><?= $likes ?> Likes</p>