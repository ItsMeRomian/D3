<?php
include_once("inc/inc.php");
?>

<body>
    <div class="container">
        <form action="" method="post">

            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" required><br>

            <label for="body">Body</label><br>
            <input type="text" name="body" id="body" required><br>

            <label for="image">Image</label><br>
            <input type="text" name="image" id="image"><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>

<?php
if (checkInput($_POST['name']) && checkInput($_POST['body']) && checkInput($_POST['image'])) {
    $insert =  $db->query(
        "INSERT INTO posts (`userId`, `name`, `body`, `image`, `timePosted`) VALUES (?, ?, ?, ?, ?)",
        $_SESSION['auth']['id'],
        $_POST['name'],
        $_POST['body'],
        $_POST['image'],
        date('Y-m-d H:i:s'),
    )->lastInsertID();
    if ($insert) {
        echo "Success: check hier je  <a href='http://localhost/D3/post?id=" . $insert . "'>post</a>";
    }
}

function checkInput($input)
{
    if (isset($input)) {
        if (strlen($input) > 5) {
            //Hier kunnnen meer checks als nodig is.
            return $input;
        } else {
            //hier misschien een error handler?
            die("Te kort! '$input' is korter dan 5 chars");
        }
    } else {
        die("Geen input binnengekregen.");
    }
}
