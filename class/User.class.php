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
}
