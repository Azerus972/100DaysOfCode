<?php

namespace DeeWeb\Test_Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager {

/**
 * Get all posts.
 *
 * This method will get all the posts from the blog.
 *
 * @return array.
 */

    public function getPosts() {

        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content_1, content_2, inner_quotes, user_id, img_head, img_inside, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM `mvc-posts` ORDER BY creation_date DESC LIMIT 0, 4');

        return $req;
    }

/**
 * Get a single Post.
 *
 * This method will get a selected post.
 *
 * @param Int | $postId represent the ID of the post.
 *
 * @return array.
 */

    public function getPost($postId) {

        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id, title, content_1, content_2, inner_quotes, user_id, img_head, img_inside, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM `mvc-posts` WHERE id = ?');
        
        $req->execute(array($postId));

        $post = $req->fetch();

        return $post;
    }
}