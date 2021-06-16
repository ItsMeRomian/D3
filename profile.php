<?php
include_once('inc/inc.php');
$account = $db->query('SELECT * FROM users WHERE id = ?', $_GET['id'])->fetchArray();

$friendsAmount = $db->query('SELECT * FROM friends WHERE user = ?', $account['id'])->numRows();
$friends = $db->query('SELECT users.*, friends.`user`, friends.friend FROM users , friends WHERE friends.`user` = ? AND friends.friend = users.id ', $account['id'])->fetchAll();

$followersAmount = $db->query('SELECT * FROM friends WHERE friend = ?', $account['id'])->numRows();
$followers = $db->query('SELECT users.id, users.username, users.profilepicture, users.`password`, users.background, users.font, users.lastLogin, users.timeCreated FROM friends , users WHERE friends.friend = ? AND friends.user = users.id', $account['id'])->fetchAll();
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