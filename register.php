<?php
include_once('inc/inc.php');

if (isset($_POST['submit'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (isset($_POST['username']) && isset($_POST['background']) && isset($_POST['profilepicture']) && isset($_POST['font']) && isset($_POST['password']) && isset($_POST['password2'])) {
        if ($_POST['password'] == $_POST['password2']) {
            if ($db->query('SELECT users.id FROM users WHERE username = ?', $_POST['username'])->numRows() < 1) {

                $result = $db->query(
                    "INSERT INTO users (`username`, `profilepicture`, `password`, `background`, `font`) VALUES (?, ?, ?, ?, ?)",
                    $_POST['username'],
                    $_POST['profilepicture'],
                    $password,
                    $_POST['background'],
                    $_POST['font']
                )->affectedRows();
                if ($result == 1) {
                    header("Location: http://localhost/D3/login?newUser");
                }
            } else {
                die("Username already in use.");
            }
        } else {
            die("Passwords do not match");
        }
    } else {
        die("Not all values are here.");
    }
}
?>

<body>
    <div class="container">
        <h1>Maak je profiel</h1>
        <form action="" method="post">

            <label for="username">username</label><br>
            <input type="text" name="username" id="username"><br>

            <label for="background">background</label><br>
            <input type="text" name="background" id="background" required><br>

            <label for="profilepicture">profilepicture</label><br>
            <input type="text" name="profilepicture" id="profilepicture"><br>

            <label for="font">font</label><br>
            <input type="text" name="font" id="font"><br>

            <label for="password">wachtwoord</label><br>
            <input type="password" name="password" id="password"><br>

            <label for="password">wachtwoord opnieuw</label><br>
            <input type="password" name="password2" id="password2"><br>

            <input type="submit" value="Submit" name="submit">

        </form>
    </div>
</body>