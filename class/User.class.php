<?php

//User class
class User
{

    private array $userObject;
    private  $db;

    function __construct(int $id, $db)
    {
        $this->db = $db;
        $this->userObject = $this->db->query('SELECT * FROM users WHERE id = ?', $id)->fetchArray();
    }
    /**
     * getUserObject
     * Get an users data
     * @return array
     */
    function getUserObject(): array
    {
        return $this->userObject;
    }


    /**
     * getFriends
     * Get friends data of an user
     * 
     * @return array
     */
    function getFriends(): array
    {
        return $this->db->query('SELECT users.*, friends.`user`, friends.friend FROM users , friends WHERE friends.`user` = ? AND friends.friend = users.id ', $this->userObject['id'])->fetchAll();
    }


    /**
     * getFriendsAmount
     * Get the amount of friends of an user.
     * @return int
     */
    function getFriendsAmount(): int
    {
        return $this->db->query('SELECT * FROM friends WHERE user = ?', $this->userObject['id'])->numRows();
    }


    /**
     * getFollowers
     * Get the data of followers of an user.
     * @return array
     */
    function getFollowers(): array
    {
        return $this->db->query('SELECT users.* FROM friends , users WHERE friends.friend = ? AND friends.user = users.id', $this->userObject['id'])->fetchAll();
    }


    /**
     * getFollowersAmount
     * Get the amount of followers of an user.
     * @return int
     */
    function getFollowersAmount(): int
    {
        return $this->db->query('SELECT * FROM friends WHERE friend = ?', $this->userObject['id'])->numRows();
    }


    /**
     * getFriendsOfFriends
     * Get the friends of friends of an user.
     * @return array
     */
    function getFriendsOfFriends(): array
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


    /**
     * followUser
     * Follow an user
     * @param  int $you
     * @return int
     */
    function followUser(int $you): int
    {
        return $this->db->query("INSERT INTO friends (`user`, `friend`, `time`) VALUES (?, ?, ?)", $this->userObject['id'], $you, $this->db->currentTime)->affectedRows();
    }


    /**
     * isFriendsWithUser
     * Check if an user is friends with another user.
     * @param  mixed $friend
     * @return int
     */
    function isFriendsWithUser(int $friend): int
    {
        return $this->db->query("SELECT * FROM friends WHERE user = ? AND friend = ?", $this->userObject['id'], $friend)->numRows();
    }


    /**
     * followsUser
     * Check if an user follows another user.
     * 
     * @param  int $user
     * @return int
     */
    function followsUser(int $user): int
    {
        return $this->db->query("SELECT * FROM friends WHERE user = ? AND friend = ?", $user, $this->userObject['id'])->numRows();
    }


    /**
     * isYou
     * Check if an user is you.
     * 
     * @param  mixed $userId
     * @return bool
     */
    function isYou(int $userId): bool
    {
        if ($userId == $_SESSION['auth']['id']) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * setBackground
     * Set the background of an user.
     * 
     * @return int
     */
    function setBackground(): int
    {
        return $this->db->query('SELECT background FROM users WHERE id = ?', $this->userObject['id'])->numRows();
    }


    /**
     * getBackground
     * Get the current background of an user.
     * @return int
     */
    function getBackground(): int
    {
        return $this->db->query('SELECT background FROM users WHERE user = ?', $this->userObject['id'])->numRows();
    }



    /**
     * updateUser
     * Update an users profile.
     * 
     * @param  string $username
     * @param  string $profilepicture
     * @param  string $background
     * @param  string $font
     * @return int
     */
    function updateUser(string $username, string $profilepicture, string $background, string $font): int
    {
        $query = $this->db->query("UPDATE users SET username = ?, profilepicture = ?, background = ?, font = ? WHERE id = ?", $username, $profilepicture, $background, $font, $this->userObject['id']);
        return $query->affectedRows();
    }


    /**
     * likePost
     * Like a post
     * 
     * @param  int $postId
     * @return bool
     */
    function likePost(int $postId): bool
    {
        if (!$this->hasLiked($postId)) {
            $this->db->query("INSERT INTO likes (`post`, `user`, `time`) VALUES (?, ?, ?)", $postId, $this->userObject['id'], $this->db->currentTime)->numRows();
            return true;
        } else {
            return false;
        }
    }


    /**
     * hasLiked
     * Check if a user already liked an post.
     * 
     * @param int $postId
     * @return bool
     */
    function hasLiked(int $postId): bool
    {
        if ($this->db->query('SELECT user FROM likes WHERE post = ? AND user = ?', $postId,  $this->userObject['id'])->numRows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
