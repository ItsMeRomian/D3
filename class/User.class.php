<?php

//User class
class User
{

    private  $userObject;
    private  $db;

    function __construct($id, $db)
    {
        $this->db = $db;
        $this->userObject = $this->db->query('SELECT * FROM users WHERE id = ?', $id)->fetchArray();
    }
    function getUserObject()
    {
        return $this->userObject;
    }
    function getFriends()
    {
        return $this->db->query('SELECT users.*, friends.`user`, friends.friend FROM users , friends WHERE friends.`user` = ? AND friends.friend = users.id ', $this->userObject['id'])->fetchAll();
    }
    function getFriendsAmount()
    {
        return $this->db->query('SELECT * FROM friends WHERE user = ?', $this->userObject['id'])->numRows();
    }
    function getFollowers()
    {
        return $this->db->query('SELECT users.* FROM friends , users WHERE friends.friend = ? AND friends.user = users.id', $this->userObject['id'])->fetchAll();
    }
    function getFollowersAmount()
    {
        return $this->db->query('SELECT * FROM friends WHERE friend = ?', $this->userObject['id'])->numRows();
    }
    function getFriendsOfFriends()
    {
        $friends = $this->getFriends();
        $friendsOfFriendsArray = array();
        $friendsOfFriends = array();
        foreach ($friends as $friend) {
            array_push($friendsOfFriendsArray, $this->db->query("SELECT users.id FROM users, friends WHERE friends.`user` = ? AND friends.friend = users.id", $friend['id'])->fetchAll());
        }
        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($friendsOfFriendsArray));
        foreach ($it as $v) {
            array_push($friendsOfFriends, $v);
        }
        return $friendsOfFriends;
    }
    function followUser($you)
    {
        return $this->db->query("INSERT INTO friends (`user`, `friend`, `time`) VALUES (?, ?, ?)", $this->userObject['id'], $you, $this->db->currentTime)->affectedRows();
    }
    function isFriendsWithUser($friend)
    {
        return $this->db->query("SELECT * FROM friends WHERE user = ? AND friend = ?", $this->userObject['id'], $friend)->numRows();
    }
    function followsUser($user)
    {
        return $this->db->query("SELECT * FROM friends WHERE user = ? AND friend = ?", $user, $this->userObject['id'])->numRows();
    }
    function isYou($user)
    {
        if ($user == $_SESSION['auth']['id']) {
            return true;
        } else {
            return false;
        }
    }
    function setBackground()
    {
        return $this->db->query('SELECT background FROM users WHERE id = ?', $this->userObject['id'])->numRows();
    }
    function getBackground()
    {
        return $this->db->query('SELECT background FROM users WHERE user = ?', $this->getUserObject['id'])->numRows();
    }

    function updateUser($username, $profilepicture, $background, $font)
    {
        $query = $this->db->query("UPDATE users SET username = ?, profilepicture = ?, background = ?, font = ? WHERE id = ?", $username, $profilepicture, $background, $font, $this->userObject['id']);
        return $query->affectedRows();
    }
}
