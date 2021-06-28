<?php
class MenuTemplate
{
    private bool $loggedIn;
    private array $user;

    function __construct($loggedIn, $user = null)
    {
        $this->loggedIn = $loggedIn;
        $this->user = $user;
    }

    function __toString()
    {
        ob_start();
?>

        <header>
            <nav>
                <ul>
                    <li><a href="http://localhost/D3/profile?id=?#">Homepage</a></li>
                    <li><a href="class/Settings.class.php">Settings</a></li>
                </ul>
            </nav>
            <nav class="right">
                <ul>
                    <li><a href="http://localhost/D3/profile?id=?#">Homepage</a></li>
                    <li><a href="class/Settings.class.php">Settings</a></li>
                </ul>
            </nav>
        </header>


        <style>
            header {
                display: grid;
                grid-template-columns: repeat(auto-fit, 1fr);
                border: 2px solid black;
                background: lightblue;
            }

            nav {
                display: flex;
            }

            ul {
                display: flex;
                list-style: none;
                align-items: center;
                justify-content: center;
            }

            li {
                padding: 0.5em;
            }

            nav a {
                text-decoration: none;
                font-size: 20px;
            }
        </style>



<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>