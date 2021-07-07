<link rel="stylesheet" href="style/menu.style.css">

<?php

//Template voor menu. Deze heeft 2 variaties, ingelogd en niet ingelogd.
class MenuTemplate
{
    private bool $loggedIn;
    private $user;

    function __construct($loggedIn, $user = null)
    {
        $this->loggedIn = $loggedIn;
        $this->user = $user;
    }

    function __toString()
    {
        //Log in versie.
        if ($this->loggedIn) {
            ob_start();
?>
            <header>
                <nav>
                    <ul>
                        <li><a href="http://localhost/D3/index">Home</a></li>
                        <li><a href="http://localhost/D3/create">New Post</a></li>
                        <li><a href="http://localhost/D3/makefriends">Vind nieuwe vrienden</a></li>
                    </ul>
                    <ul class="right">
                        <li><a href="http://localhost/D3/profile?id=<?= $this->user['id'] ?>"><?= $this->user['username'] ?></a></li>
                        <li><a href="http://localhost/D3/logout">Logout</a></li>
                    </ul>
                </nav>
            </header>
        <?php
            //Niet ingelogde versie
        } else {
            ob_start();
        ?>

            <header>
                <nav>
                    <ul>
                        <li><a href="http://localhost/D3/index">Home</a></li>
                    </ul>
                    <ul class="right">
                    </ul>
                </nav>
            </header>

<?php
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>