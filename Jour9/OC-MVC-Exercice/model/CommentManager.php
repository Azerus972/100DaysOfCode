<?php

namespace DeeWeb\Test_Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager {

/**
 * Get all comments from a single post.
 *
 * This method will get all comments from a single post.
 *
 * @param Int | $postId represent the ID of the post allowing to get the related comments.
 *
 * @return array.
 */

    public function getComments($postId) {

        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM `mvc-comments` WHERE post_id = ? ORDER BY comment_date DESC');

        $comments->execute(array($postId));

        return $comments;
    }

/**
 * Post a new Comment.
 *
 * This method will post a new comment.
 *
 * @param Int | $postId represent the ID of the post.
 * @param String | $author represent the author name.
 * @param String | $comment represent the content of the new comment.
 *
 * @return array.
 */

    public function postComment($postId, $author, $comment) {

        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO `mvc-comments`(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
       
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

/**
 * Get comment to modify.
 *
 * This method will get a selected comment to be modified.
 *
 * @param Int | $commentID represent the ID of the comment.
 *
 * @return array.
 */

    public function getComment($commentID) {

        $db = $this->dbConnect();

        $req = $db->prepare('SELECT id, comment FROM `mvc-comments` WHERE id = ?');

        $req->execute(array($commentID));

        $comment = $req->fetch();

        return $comment;
    }

/**
 * Modify a Comment.
 *
 * This method will modify a comment.
 *
 * @param Int | $commentID represent the ID of the comment.
 * @param String | $content represent the content of the modified comment.
 *
 * @return array.
 */

    public function modifyComment($commentID, $content) {

        $db = $this->dbConnect();

        $comment = $db->prepare('UPDATE `mvc-comments` SET comment = ? WHERE id = ?');
       
        $affectedLines = $comment->execute(array($content, $commentID));

        return $affectedLines;
     }
}