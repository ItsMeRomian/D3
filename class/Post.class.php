<?php
include('inc/inc.php');
class Post
{
    private  $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    function getPostFromFriends($loggedInUserId)
    {
        return $this->db->query('SELECT posts.* FROM posts, friends WHERE friends.friend = posts.userId AND friends.`user` = ?', $loggedInUserId)->fetchAll();
    }
}
