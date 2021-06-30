<?php
include_once('inc/inc.php');
include_once('class/Settings.class.php');
//Account of the user we're viewing
$user = new User($_GET['id'], $db);
$account = $user->getUserObject();

//Posts of account
$userPosts = $posts->getPostsFromUser($account['id']);
//Friends data
$friendsAmount = $user->getFriendsAmount();
$friends = $user->getFriends();

//Followers data
$followersAmount = $user->getFollowersAmount();
$followers = $user->getFollowers()
?>
<h1><?= $account['username'] ?></h1>
<p>
    <?php
    //Dit displayed of je de user volgt / of de user jou volgt
    if ($user->isYou($_GET['id'])) {
        if ($user->isFriendsWithUser($_SESSION['auth']['id'])) { ?>
            You are friends with this user. <br>
        <?php } else { ?>
            You are not following this user. <a href="profile?id=<?= $_GET['id'] ?>&followUser">Follow user</a><br>
        <?php }
        if ($user->followsUser($_SESSION['auth']['id'])) { ?>
            This user follows you.<br>
        <?php } else { ?>
            This user does not follow you.<br>
        <?php }
    } else { ?>
        jij bent dit.
    <?php } ?>

</p>

<p><?= $friendsAmount ?> friends</p>
<p><?= $followersAmount ?> followers</p>

<b>friends</b>
<table>
    <?php foreach ($friends as $friend) { ?>
        <tr>
            <td><?= $friend['id'] ?></td>
            <td><a href="profile?id=<?= $friend['id'] ?>"><?= $friend['username'] ?></a></td>
        </tr>
    <?php } ?>
</table>

<b>followers</b>
<table>
    <?php foreach ($followers as $follower) { ?>
        <tr>
            <td><?= $follower['id'] ?></td>
            <td><a href="profile?id=<?= $follower['id'] ?>"><?= $follower['username'] ?></a></td>
        </tr>
    <?php } ?>
</table>

<h1>Alle fotos van <?= $account['username'] ?></h1>
<?php foreach ($userPosts as $post) { ?>
    <a href="http://localhost/D3/post?id=<?= $post['id'] ?>"><img src="<?= $post['image'] ?>"></a>
<?php } ?>


<h2>Posts by <?= $account['username'] ?></h2>
<?php
if (isset($_GET['followUser'])) {
    if (!$user->isFriendsWithUser($_SESSION['auth']['id'])) {
        if ($user->followUser($_SESSION['auth']['id'])) {
            echo "<h1 style='color: green'>Je volgt nu deze user</h1>";
        }
    } else {
        echo "<h1 style='color: red'>Je volgt deze user al</h1>";
    }
}

foreach ($userPosts as $post) {
    //Haal ook de user object op zodat we bv username kunnen laten zien.
    $userWhoPosted = new User($post['userId'], $db);
    $post['user'] = $userWhoPosted->getUserObject();

    echo new PostTemplate($post);
}
