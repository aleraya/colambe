<?php
?>

<form action="" method='post'>
<?= $form->input('name', 'Evénement', true); ?>
<?= $form->input('order_nb', 'N°ordre d\'affichage'); ?>

<button>
    <?php if ($pricesection ->getId() !== null) : ?>
        Modifier
    <?php else: ?>
        Créer
    <?php endif ?>
</button>
<a href="<?= $router->url("admin_pricesections")?>" class="button">Retour</a>
</form>
