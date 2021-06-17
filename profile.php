<?php
include_once('inc/inc.php');
$user = new User($_GET['id'], $db);
$account = $user->getUserObject();

$friendsAmount = $user->getFriendsAmount();
$friends = $user->getFriends();

$followersAmount = $user->getFollowersAmount();
$followers = $user->getFollowers()
?>
<h1><?=$account['username']?></h1>

<p><?=$friendsAmount?> friends</p>
<p><?=$followersAmount?> followers</p>
<p>Your friends</p>
<table>
    <?php foreach($friends as $friend) { ?>
    <tr>
        <td><?=$friend['id']?></td>
        <td><a href="profile?id=<?=$friend['id']?>"><?=$friend['username']?></a></td>
    </tr>
    <?php } ?>
</table>

<p>Your followers</p>
<table>
    <?php foreach($followers as $follower) { ?>
    <tr>
        <td><?=$follower['id']?></td>
        <td><a href="profile?id=<?=$follower['id']?>"><?=$follower['username']?></a></td>
    </tr>
    <?php } ?>
</table>