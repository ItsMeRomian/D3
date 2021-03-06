<link rel="stylesheet" href="style/main.style.css">
<link rel="stylesheet" href="style/menu.style.css">
<link rel="stylesheet" href="style/post.style.css">

<?php
//Error display aan
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Start een session op elke pagina. Zo kunnen we bij auth
if (!isset($_SESSION)) {
    session_start();
}
//Als je niet bent ingelogd en je bent niet op /login dan word je daarnatoe geroute.

//TODO: dit kan korter
if (empty($_SESSION['auth'])) {
    if ($_SERVER['REQUEST_URI'] !== "/D3/login") {
        if ($_SERVER['REQUEST_URI'] !== "/D3/register") {
            if ($_SERVER['REQUEST_URI'] !== "/D3/login?newUser") {
                if ($_SERVER['REQUEST_URI'] !== "/D3/login?loggedout") {
                    header('Location: login');
                }
            }
        }
    }
}

//Include alle templates.
include_once('templates/post.template.php');
include_once('templates/menu.template.php');
include_once('templates/user.template.php');


//Include DB en start deze.
include_once('class/DB.class.php');
$db = new db('dev.dyna.host', 'dg3', 'password', 'dg3');

//Include alle andere classes.
include_once('class/User.class.php');
include_once('class/Post.class.php');
$posts = new Post($db);
include_once('class/Auth.class.php');

//include_once('class/Settings.class.php');
include_once('class/Error.class.php');

//Display menu op elke pagina.
if (empty($_SESSION['auth'])) {
    $_SESSION['auth'] = null;
}
echo new MenuTemplate(isset($_SESSION['auth']), $_SESSION['auth']);
