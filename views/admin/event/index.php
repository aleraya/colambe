<?php

use App\Auth;
use App\Connection;
use App\Table\EventTable;

Auth::check();

$title = "Administration événements | Colambe";

$pdo = Connection::getPDO();

$table = new EventTable($pdo);
$events = $table->findAll();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion des événements</h1>

    <?php if (isset($_GET['delete'])): ?>
        <div class="valid">
            L'événement a bien été supprimé
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">L'événement a bien été créé</div>
    <?php endif; ?>
    <?php if(isset($_GET['update'])): ?>
        <div class="valid">L'événement a bien été mis à jour</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>N° ordre</th>
            <th>Nom</th>
            <th>Date</th>
            <th><a href="<?= $router->url("admin_event_new")?>" class="button">Nouveau</a></th>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?=$event->getId()?></td>
                    <td><?=$event->getOrderNb()?></td>
                    <td><?=$event->getName()?></td>
                    <!-- <td><a href="?= $router->url("admin_event",['id'=>$event->getId()])?>">?=htmlentities($event->getName())?></a></td> -->
                    <td><?=$event->getDate()?></td>
                    <td>
                        <a href="<?= $router->url("admin_event",['id'=>$event->getId()])?>" class="button">Editer</a>
                        <form action="<?= $router->url("admin_event_delete",['id'=>$event->getId()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

