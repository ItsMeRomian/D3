<?php
include_once('inc/inc.php');
//Account of the user we're viewing
$user = new User($_SESSION['auth']['id'], $db);
$account = $user->getUserObject();

//Check if your editing your own profile.
if (!$user->isYou($account['id'])) {
    $error = new ErrorHandler(1, "Auth failed");
    $error->killing();
}

//Start update profile
if (isset($_POST['submit'])) {

    //Check of alle values wel zijn ingevult
    if (!empty($_POST['username']) && !empty($_POST['background']) && !empty($_POST['profilepicture']) && !empty($_POST['font'])) {
        if ($user->updateUser($_POST['username'], $_POST['profilepicture'], $_POST['background'], $_POST['font']) == 1) {
            header("Location: http://localhost/D3/profile?id=" . $account['id']);
        } else {
            $error = new ErrorHandler(3, "Iets ging fout tijdens het updaten van je account. Probeer het opnieuw.");
            $error->killing();
        }
    }
}

?>

<body>
    <div class="container">
        <h1>Bewerk je profiel</h1>
        <form action="" method="post">

            <label for="username">username</label><br>
            <input type="text" name="username" id="username" value="<?= $account['username'] ?>"><br>

            <label for="background">background</label><br>
            <input type="text" name="background" id="background" required value="<?= $account['background'] ?>"><br>

            <label for="profilepicture">profilepicture</label><br>
            <input type="text" name="profilepicture" id="profilepicture" value="<?= $account['profilepicture'] ?>"><br>

            <label for="font">font</label><br>
            <input type="text" name="font" id="font" value="<?= $account['font'] ?>"><br>

            <input type="submit" value="Submit" name="submit">

        </form>
    </div>
</body>