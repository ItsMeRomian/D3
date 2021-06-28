<?php

//Auth class. Deze class handeld Authenticatie.
class Auth
{
    private $username;
    private $password;

    private $db;

    function __construct($username = null, $password = null, $db = null)
    {
        echo "AUTH constuct";
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;

        //Check of de user al is ingelogd wanneer deze class word gemaakt.
        if (empty($_SESSION['auth'])) {
            if ($this->verifyAccount()) {
            }
        }
    }

    private function verifyAccount()
    {
        echo "AUTH verify";
        $check =  $this->db->query('SELECT users.password, users.id FROM users WHERE username = ?', $this->username)->fetchArray();
        //Check of de user in de database staat.
        if (isset($check['password'])) {
            //Check of de password matched
            if (password_verify($this->password, $check['password'])) {
                echo "AUTH verify complete";
                $this->setLoggedinUser($check['id']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Set de User object in session.
    private function setLoggedinUser($userId)
    {
        echo "setting logged user";
        $user = new User($userId, $this->db);
        $_SESSION['auth'] = $user->getUserObject();
    }

    public function logout(): void
    {
        $_SESSION['auth'] = null;
        session_destroy();
    }
}
