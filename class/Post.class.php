<?php
class Post
{
    private  $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * getPostFromFriends
     * Get friends posts from an user
     * 
     * @param  int $loggedInUserId
     * @return array
     */
    public function getPostFromFriends(int $loggedInUserId): array
    {
        return $this->db->query('SELECT userId, id, name, body, image, timePosted FROM posts, friends WHERE friends.friend = posts.userId AND friends.user = ? GROUP BY userId ORDER BY timePosted', $loggedInUserId)->fetchAll();
    }

    /**
     * getPostsFromUser
     * Get all posts from an user
     * 
     * @param  int $userId
     * @return array
     */
    public function getPostsFromUser(int $userId): array
    {
        return $this->db->query('SELECT * FROM posts where userId = ?', $userId)->fetchAll();
    }


    /**
     * getPost
     * Get a post
     * 
     * @param  int $postId
     * @return array
     */
    public function getPost(int $postId): array
    {
        return $this->db->query('SELECT * FROM posts where id = ?', $postId)->fetchArray();
    }


    /**
     * isOwnerOfPost
     * Get the user of a post.
     * 
     * @param  int $postId
     * @return bool
     */
    public function isOwnerOfPost(int $postId): bool
    {
        $post = $this->db->query('SELECT userId FROM posts where id = ?', $postId)->fetchArray();
        if ($post['userId'] === $_SESSION['auth']['id']) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * deletePost
     * Delete an post
     * 
     * @param  int $postId
     * @return bool
     */
    public function deletePost(int $postId): bool
    {
        if ($this->db->query('DELETE FROM posts where id = ?', $postId)->affectedRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
