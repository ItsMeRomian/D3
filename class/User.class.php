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
}
