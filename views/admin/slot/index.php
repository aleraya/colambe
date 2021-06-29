<?php

use App\Auth;
use App\Connection;
use App\Table\SlotTable;

Auth::check();

$title = "Administration créneaux | Colambe";
$pdo = Connection::getPDO();

$table = new SlotTable($pdo);
$slots = $table->allOrderByTime();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion des créneaux</h1>

    <?php if (isset($_GET['delete'])): ?>
        <div class="valid">
            Le créneau a bien été supprimé
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">Le créneau a bien été créé</div>
    <?php endif; ?>
    <?php if(isset($_GET['update'])): ?>
        <div class="valid">Le créneau a bien été mis à jour</div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Jour</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th><a href="<?= $router->url("admin_slot_new")?>" class="button">Créer</a></th>
        </thead>
        <tbody>
            <?php foreach ($slots as $slot): ?>
                <tr>
                    <td><?=$slot->getId()?></td>
                    <td><?=$slot->getDayname()?></td>
                    <td><?=$slot->getStartTimeToDateTime()->format('H:i')?></td>
                    <td><?=$slot->getEndTimeToDateTime()->format('H:i')?></td>
                    <td>
                        <a href="<?= $router->url("admin_slot",['id'=>$slot->getId()])?>" class="button">Editer</a>
                        <form action="<?= $router->url("admin_slot_delete",['id'=>$slot->getId()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

