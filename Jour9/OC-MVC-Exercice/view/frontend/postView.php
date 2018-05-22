<?php $title = 'Article'; ?>

<?php ob_start(); ?>

    <div id="header">
        <h1>Mon super blog !</h1>
        <p><a href="../../index.php">Retour à la liste des billets</a></p>
    </div>
    <div class="news">
        <h2><?= $post['title'] ?></h2>
        <em>Ecrit le <?= $post['creation_date_fr'] ?></em>
        <img class="img1" src="images/posts-img/<?= $post['img_head'] ?>" alt="top image">
        <?= $post['content_1'] ?>
        <h3>"<?= $post['inner_quotes'] ?>"</h3>
        <?= $post['content_2'] ?>
        <img class="img2" src="images/posts-img/<?= $post['img_inside'] ?>" alt="bottom image">
    </div>
    <div id="comm">      
        <h2>Commentaires</h2>
    </div>

        <?php

        while ($comment = $comments->fetch())
        {
        ?>  <div class="news newsList">
                <p><strong><?= $comment['author'] ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p><?= $comment['comment'] ?></p><br>
                <a href="index.php?action=modify&amp;comment=<?= $comment['id'] ?>&amp;post=<?= $post['id'] ?>">Modifier</a>
                <br>
            </div>

        <?php
        }
        $comments->closeCursor();
        ?>

<h2 id="titreAddComm">Ecrire un Commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <br>
        <label for="author">Auteur</label>
        <input type="text" id="author" name="author">
    </div>
    <div>
        <br>
        <label for="comment">Commentaire</label>
        <textarea id="comment" name="comment" rows="20" cols="100"></textarea>
    </div>
    <div>
        <br>
        <button type="submit" value="Envoyer">Envoyer</button>
        <br>
    </div>
</form>

<?php $content = ob_get_clean();

require('header.php');
require('footer.php');
?>
