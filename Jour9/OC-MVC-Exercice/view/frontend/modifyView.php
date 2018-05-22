<?php $title = 'Modification'; ?>

<?php ob_start(); ?>
<a href="?action=post&id=<?= $_GET['post'] ?>">Annuler</a>
<h2 id="titreAddComm">Modifier votre Commentaire</h2>

<form action="index.php?action=modified&amp;comment=<?= $comment['id'] ?>&amp;post=<?= $_GET['post'] ?>" method="post">
    <div>
        <br>
        <textarea id="comment" name="modifiedComment" rows="20" cols="100" value=""><?= $comment['comment'] ?></textarea>
    </div>
    <div>
        <br>
        <button type="submit" value="Valider">Valider</button>
        <br>
    </div>
</form>

<?php $content = ob_get_clean();

require('header.php');
require('footer.php');
?>