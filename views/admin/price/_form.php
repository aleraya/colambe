<form action="" method="post">
    <?= $form->select('pricesection_id', 'Rubrique', $pricesections, true); ?>  
    <?= $form->input('name', 'Descriptif', true); ?>
    <?= $form->input('text', 'Complément'); ?>
    <?= $form->input('price', 'Tarif'); ?>
    <?= $form->select('pricetype_id', 'Type', $pricetypes); ?>  

    <button>
        <?php if ($price->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Créer
        <?php endif;?>
    </button>
    <a href="<?= $router->url("admin_prices")?>" class="button">Retour</a>
</form>