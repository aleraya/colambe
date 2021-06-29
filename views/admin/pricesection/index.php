<?php

use App\Auth;
use App\Connection;
use App\Table\PriceSectionTable;

Auth::check();

$title = "Administration des rubriques des tarifs | Colambe";
$pdo = Connection::getPDO();

$table = new PriceSectionTable($pdo);
$sections = $table->findAll();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion des rubriques des tarifs</h1>

    <?php if (isset($_GET['delete'])): ?>
        <div class="valid">
            La rubrique a bien été supprimée
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">La rubrique a bien été créée</div>
    <?php endif; ?>
    <?php if(isset($_GET['update'])): ?>
        <div class="valid">La rubrique a bien été mise à jour</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>N° ordre</th>
            <th>Nom</th>
            <th><a href="<?= $router->url("admin_pricesection_new")?>" class="button">Créer</a></th>
        </thead>
        <tbody>
            <?php foreach ($sections as $section): ?>
                <tr>
                    <td><?=$section->getId()?></td>
                    <td><?=$section->getOrderNb()?></td>
                    <td><?=$section->getName()?></td>
                    <td>
                        <a href="<?= $router->url("admin_pricesection",['id'=>$section->getId()])?>" class="button">Editer</a>
                        <form action="<?= $router->url("admin_pricesection_delete",['id'=>$section->getId()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

