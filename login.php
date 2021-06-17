<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <input type="text" name="username"><br>
        <input type="password" name="password"><br>
        <button type="submit" name="submit">Submit</button>
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
include_once('inc/inc.php');

//Check of je al bent ingelogd, als je dat bent dan ga je naar /index
if ($_SESSION['auth']) {
    header('Location: index');
}

//Als de form is ingevult starten we Auth()
if (isset($_POST['password'])) {
    echo "pass is set";
    $auth = new Auth($_POST['username'], $_POST['password'], $db);
}
