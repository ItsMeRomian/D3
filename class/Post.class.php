<?php
class Post
{
    private  $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    public function getPostFromFriends($loggedInUserId)
    {
        return $this->db->query('SELECT posts.* FROM posts, friends WHERE friends.friend = posts.userId AND friends.`user` = ?', $loggedInUserId)->fetchAll();
    }

    public function getPostsFromUser($userId)
    {
        return $this->db->query('SELECT * FROM posts where userId = ?', $userId)->fetchAll();
    }
    public function getPost($postId)
    {
        return $this->db->query('SELECT * FROM posts where id = ?', $postId)->fetchArray();
    }
}
