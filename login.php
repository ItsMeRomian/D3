<?php
include_once('inc/inc.php');

//Tel users, posts en friends relaties om te laten zien.
$amountUsers = $db->query("SELECT COUNT(id) FROM users")->fetchArray()['COUNT(id)'];
$amountPosts = $db->query("SELECT COUNT(id) FROM posts")->fetchArray()['COUNT(id)'];
$amountFriends = $db->query("SELECT COUNT(user) FROM friends")->fetchArray()['COUNT(user)'];


//Select een random user om mee in te loggen.
$randomUsername = $db->query("SELECT username FROM users ORDER BY RAND() LIMIT 1")->fetchArray()['username'];

if (isset($_GET['loggedout'])) {
    echo "<span style='color:green'>Je bent successvol uitgelogd</span>";
}
if (isset($_GET['newUser'])) {
    echo "<span style='color:green'>Je account is succesvol aangemaakt. je kunt nu inloggen</span>";
}
?>

<body>
    <form action="login.php" method="post">
        <h1>Welkom op D3</h1>
        <p>
            <?= $amountUsers ?> Accounts aangemaakt.<br>
            <?= $amountPosts ?> Posts aangemaakt.<br>
            <?= $amountFriends ?> Vrienden aangemaakt.<br>
        </p>
        <h2>Login</h2>
        <input type="text" name="username" value="<?= $randomUsername ?>"><br>
        <input type="password" name="password" value="Password"><br>
        <button type="submit" name="submit">Submit</button>
        <a href="register">Geen account?</a>
    </form>
</body>
<style>
    form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<?php

//Check of je al bent ingelogd, als je dat bent dan ga je naar /index
if (isset($_SESSION['auth'])) {
    header('Location: index');
}

//Als de form is ingevult starten we Auth()
if (isset($_POST['password'])) {
    echo "pass is set";
    $auth = new Auth($_POST['username'], $_POST['password'], $db);
}
