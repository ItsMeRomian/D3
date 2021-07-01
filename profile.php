<?php
include_once('inc/inc.php');

//Check of id is geset
if (empty($_GET['id'])) {
    $err = new ErrorHandler(1, "No User selected.");
    $err->killing();
}

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
$followers = $user->getFollowers();

//Volger toevoegen
if (isset($_GET['followUser'])) {
    if (!$user->isFriendsWithUser($_SESSION['auth']['id'])) {
        if ($user->followUser($_SESSION['auth']['id'])) {
            header("http://localhost/D3/profile?id=" + $_GET['id'] + "&followedSuccess");
        }
    } else {
        $error = new ErrorHandler(2, "Je volgt deze user al.");
        $error->soft();
    }
}
?>

<div class="profileHeader">
    <img src="<?= $account['profilepicture'] ?>" class="profilepicture">
    <h1><?= $account['username'] ?></h1>
    <p>
        <?php
        //Dit displayed of je de user volgt / of de user jou volgt
        if (!$user->isYou($_GET['id'])) {
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
</div>

<div class="tables">
    <div class="friendsTable">
        <b><?= $friendsAmount ?> friends</b>
        <table>
            <?php foreach ($friends as $friend) { ?>
                <tr>
                    <td><?= $friend['id'] ?></td>
                    <td><a href="profile?id=<?= $friend['id'] ?>"><?= $friend['username'] ?></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="followersTable">
        <b><?= $followersAmount ?> followers</b>
        <table>
            <?php foreach ($followers as $follower) { ?>
                <tr>
                    <td><?= $follower['id'] ?></td>
                    <td><a href="profile?id=<?= $follower['id'] ?>"><?= $follower['username'] ?></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<h1>Alle fotos van <?= $account['username'] ?></h1>
<?php foreach ($userPosts as $post) { ?>
    <a href="http://localhost/D3/post?id=<?= $post['id'] ?>"><img src="<?= $post['image'] ?>"></a>
<?php } ?>


<h2>Posts by <?= $account['username'] ?></h2>
<?php
foreach ($userPosts as $post) {
    //Haal ook de user object op zodat we bv username kunnen laten zien.
    $userWhoPosted = new User($post['userId'], $db);
    $post['user'] = $userWhoPosted->getUserObject();

    echo new PostTemplate($post);
}
