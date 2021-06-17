<?php
include_once('inc/inc.php');
include_once('templates/post.template.php');
$post = new Post($db);
$posts = $post->getPostFromFriends(0);
foreach ($posts as $post) {
   echo new PostTemplate($post); 
}
?>