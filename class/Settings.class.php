<?php
include_once('class/DB.class.php');

$db = new DB();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $background = $_POST['background_page'];
    $updateBackgroundQuery = "UPDATE users SET background='$background' WHERE id='1'";
    $db->query($updateBackgroundQuery);
}



?>

<html>
<body style="background-color: <?php $result ?>">
    <form action="" method="post">
    <p>Choose background color!</p>
    <select id="background_page" name="background_page">
    <option value="#FF0000">Red</option>
    <option value="#0000FF">Blue</option>
    <option value="#00FF00">Green</option>
    <option value="#FFFF00">Yellow</option>
    <option value="#800080">Purple</option>
    <option value="#FFFFFF">White</option>
    </select>
    <input type="submit" name="background_submit">
    </form>
</body>
</html>