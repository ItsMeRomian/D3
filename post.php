<?php
include_once('inc/inc.php');

//Get the post
$post = $posts->getPost($_GET['id']);

//Check if the posts exists
if (empty($post)) {
    die("post not found!");
}

//Get the userobject of the user who posted
$user = new User($post['userId'], $db);
$userObject = $user->getUserObject();

//Get your own userObject
$you = new User($_SESSION['auth']['id'], $db);
//$yourObject = $you->getUserObject();
if (isset($_GET['likePost'])) {
    if ($you->likePost($post['id'])) {
        header("Location: http://localhost/D3/post?id=" . $_GET['id']);
    } else {
        $error = new ErrorHandler(3, "YOu have already liked this post");
        $error->soft();
    }
}



//Check of je een post van jezelf viewed.
if ($posts->isOwnerOfPost($_GET['id'])) {

    //Delete handler
    if (isset($_GET['del'])) {
        $posts->deletePost($_GET['id']);
        header("Refresh:0");
    }
?>
    <a class="btn" href="http://localhost/D3/post?id=<?= $_GET['id'] ?>&del=1">Delete post</a>
<?php
}

//Get the likes
$likes = $db->query('SELECT * FROM likes WHERE post = ?', $post['id'])->numRows();

?>
<h1><?= $post['name'] ?></h1>
<h2>By <a href="profile.php?id=<?= $userObject['id'] ?>"><?= $userObject['username'] ?></a></h2>
<p><?= $post['body'] ?></p>
<img src="<?= $post['image'] ?>" style="max-height: 15rem;">
<p><?= $likes ?> Likes</p>
<?php if ($you->hasLiked($_GET['id'])) { ?>
    You have liked this post
<?php } else { ?>
    <a href="post?id=<?= $post['id'] ?>&likePost=1">Like post</a>
<?php } ?>