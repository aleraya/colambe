<?php
?>

<form action="" method='post' enctype="multipart/form-data">
<?php if($createNewTable): ?>
    <?= $form->input('name', 'Nom de la table', true, ''); ?>
<?php else: ?>
    <?= $form->input('name', 'Nom de la table', false, 'readonly'); ?>
<?php endif ?>
<?= $form->input('code', 'Code', true); ?>
<?= $form->input('value', 'Valeur', true); ?>

<button>
    <?php if ($config ->getId() !== null) : ?>
        Modifier
    <?php else: ?>
        Créer
    <?php endif ?>
</button>
<?php if($createNewTable): ?>
    <a href="<?= $router->url("admin_tables")?>" class="button">Retour</a>
<?php else: ?>
    <a href="<?= $router->url("admin_table_edit",['table'=>$config->getName()])?>" class="button">Retour</a>
<?php endif ?>
</form>
