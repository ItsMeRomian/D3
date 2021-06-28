<?php
include_once('inc/inc.php');
include_once('class/Menu.class.php');

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

<p><?= $friendsAmount ?> friends</p>
<p><?= $followersAmount ?> followers</p>
<p>Your friends</p>
<table>
    <?php foreach ($friends as $friend) { ?>
        <tr>
            <td><?= $friend['id'] ?></td>
            <td><a href="profile?id=<?= $friend['id'] ?>"><?= $friend['username'] ?></a></td>
        </tr>
    <?php } ?>
</table>

<p>Your followers</p>
<table>
    <?php foreach ($followers as $follower) { ?>
        <tr>
            <td><?= $follower['id'] ?></td>
            <td><a href="profile?id=<?= $follower['id'] ?>"><?= $follower['username'] ?></a></td>
        </tr>
    <?php } ?>
</table>

<h2>Posts by <?= $account['username'] ?></h2>
<?php
foreach ($userPosts as $post) {
    //Haal ook de user object op zodat we bv username kunnen laten zien.
    $userWhoPosted = new User($post['userId'], $db);
    $post['user'] = $userWhoPosted->getUserObject();

    echo new PostTemplate($post);
}
