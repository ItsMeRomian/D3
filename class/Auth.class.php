<?php

//Auth class. Deze class handeld Authenticatie.
class Auth
{
    private $username;
    private $password;

    private $db;

    /**
     * __construct()
     * Handle the user authentication and validation
     *
     * @param  string $username
     * @param  string $password
     * @param  class $db
     * @return void
     */
    function __construct(string $username, string $password, $db)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;

        //Check of de user al is ingelogd wanneer deze class word gemaakt.
        if (empty($_SESSION['auth'])) {
            if ($this->verifyAccount()) {
            }
        }
    }

    /**
     * verifyAccount()
     * Verify if a given password matches whats on record.
     * 
     * @return bool
     */
    private function verifyAccount()
    {
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

    /**
     * setLoggedinUser()
     * Set de User object in session.    
     * 
     * @param  int $userId
     * @return void
     */
    private function setLoggedinUser($userId)
    {
        echo "setting logged user";
        $user = new User($userId, $this->db);
        $_SESSION['auth'] = $user->getUserObject();
        header("Refresh:0");
    }
}
