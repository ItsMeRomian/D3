<?php
include_once('inc/inc.php');
$post = new Post($db);
$posts = $post->getPostFromFriends($_SESSION['auth']['id']);
?>

<h1>Welkom, <a href="profile?id=<?= $_SESSION['auth']['id'] ?>"><?= $_SESSION['auth']['username'] ?></a></h1>

<p>Posts van je vrienden:</p>
<?php
foreach ($posts as $post) {
   //Haal ook de user object op zodat we bv username kunnen laten zien.
   $userWhoPosted = new User($post['userId'], $db);
   $post['user'] = $userWhoPosted->getUserObject();

   echo new PostTemplate($post);
}
