<form action="" method="post">
    <?= $form->select('day', 'Jour', $days, true); ?>  
    <?= $form->input('start_time', 'Heure début', true); ?>
    <?= $form->input('end_time', 'Heure fin', true); ?>

    <button>
        <?php if ($slot->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif;?>
    </button>
    <a href="<?= $router->url("admin_slots")?>" class="button">Retour</a>
</form>