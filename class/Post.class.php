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
        return $this->db->query('SELECT userId, id, name, body, image, timePosted FROM posts, friends WHERE friends.friend = posts.userId AND friends.user = ? GROUP BY userId ORDER BY timePosted', $loggedInUserId)->fetchAll();
    }

    public function getPostsFromUser($userId)
    {
        return $this->db->query('SELECT * FROM posts where userId = ?', $userId)->fetchAll();
    }
    public function getPost($postId)
    {
        return $this->db->query('SELECT * FROM posts where id = ?', $postId)->fetchArray();
    }

    public function isOwnerOfPost($postId)
    {
        $post = $this->db->query('SELECT userId FROM posts where id = ?', $postId)->fetchArray();
        if ($post['userId'] === $_SESSION['auth']['id']) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($postId)
    {
        if ($this->db->query('DELETE FROM posts where id = ?', $postId)->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
