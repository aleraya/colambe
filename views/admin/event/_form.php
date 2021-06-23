<?php
?>

<form action="" method='post' enctype="multipart/form-data">
<?= $form->input('name', 'Evénement', true); ?>
<?= $form->input('date', 'Date de l\'événement', true); ?>
<?= $form->input('place', 'Lieu de l\'événement', true); ?>
<?= $form->input('fb_url', 'Lien facebook'); ?>
<?= $form->file('img', 'Nouvelle photo', false, 'picture', 'Photo de l\'événement'); ?> 
<?= $form->input('order_nb', 'N°ordre d\'affichage'); ?>

<button>
    <?php if ($event ->getId() !== null) : ?>
        Modifier
    <?php else: ?>
        Créer
    <?php endif ?>
</button>
<a href="<?= $router->url("admin_events")?>" class="button">Retour</a>
</form>
