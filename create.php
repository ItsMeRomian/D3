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

            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>

<?php
if (isset($_POST['submit'])) {
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
}

function checkInput($input)
{
    if (isset($input)) {
        if (strlen($input) > 5) {
            return $input;
        } else {
            $error = new ErrorHandler(8, "Te kort! '$input' is korter dan 5 chars");
            $error->soft();
        }
    } else {
        $error = new ErrorHandler(8, "Geen input binnengekregen.");
        $error->soft();
    }
}
