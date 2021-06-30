<?php
include_once('inc/inc.php');

$user = new User($_SESSION['auth']['id'], $db);
$friendsOfFriends = $user->getFriendsOfFriends();
?>
<h1>Vind nieuwe vrienden</h1>
<p>Hier zie je vrienden van vrienden, die nog niet jou vrienden zijn.</p>
<pre>
<?php foreach ($friendsOfFriends as $friend) {
    $user = new User($friend, $db);
    echo new UserTemplate($user->getUserObject());
    echo "<br>";
}
?>
</pre>