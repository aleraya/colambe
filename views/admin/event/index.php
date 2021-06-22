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
            L'enregistrement a bien été supprimé
        </div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Nom</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?=$event->getId()?></td>
                    <td><a href="<?= $router->url("admin_event",['id'=>$event->getId()])?>"><?=htmlentities($event->getName())?></a></td>
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

