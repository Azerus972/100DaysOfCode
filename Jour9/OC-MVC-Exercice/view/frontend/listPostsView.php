<?php $title = 'Liste des posts'; ?>

<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h2><a href="?action=post&id=<?= $data['id'] ?>"><?= $data['title'] ?></a></h2>
        <em>Ecrit le <?= $data['creation_date_fr'] ?></em>
        <img class="img1" src="images/posts-img/<?= $data['img_head'] ?>" alt="top image">
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php
require('header.php');
require('footer.php');
?>