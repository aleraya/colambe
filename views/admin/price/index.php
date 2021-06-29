<?php

use App\Auth;
use App\Connection;
use App\Table\PriceTable;

Auth::check();

$title = "Administration des tarifs | Colambe";
$pdo = Connection::getPDO();

$table = new PriceTable($pdo);
$prices = $table->findAll();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion des tarifs</h1>

    <?php if (isset($_GET['delete'])): ?>
        <div class="valid">
            Le tarif a bien été supprimé
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">Le tarif a bien été créé</div>
    <?php endif; ?>
    <?php if(isset($_GET['update'])): ?>
        <div class="valid">Le tarif a bien été mis à jour</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Rubrique</th>
            <th>Descriptif</th>
            <th>Complément</th>
            <th>Tarif</th>
            <th>Type</th>
            <th><a href="<?= $router->url("admin_price_new")?>" class="button">Créer</a></th>
        </thead>
        <tbody>
            <?php foreach ($prices as $price): ?>
                <tr>
                    <td><?=$price->getId()?></td>
                    <td><?=$price->getPriceSection()?></td>
                    <td><?=$price->getName()?></td>
                    <td><?=$price->getText()?></td>
                    <td><?=$price->getPrice()?></td>
                    <td><?=$price->getPriceType()?></td>
                    <td>
                        <a href="<?= $router->url("admin_price",['id'=>$price->getId()])?>" class="button">Editer</a>
                        <form action="<?= $router->url("admin_price_delete",['id'=>$price->getId()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

