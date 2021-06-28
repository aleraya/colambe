<?php

use App\Auth;
use App\Connection;
use App\Table\ConfigTable;

Auth::check();

$title = "Administration tables | Colambe";
$pdo = Connection::getPDO();

$configTable = new ConfigTable($pdo);
$tables = $configTable->findDistinctTable();
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion des tables</h1>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">La table a bien été créée</div>
    <?php endif; ?>
    <?php if(isset($_GET['delete'])): ?>
        <div class="valid">L'enregistrement a bien été supprimé</div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <th>Table</th>
            <th><a href="<?= $router->url("admin_table_new")?>" class="button">Créer</a></th>
        </thead>
        <tbody>
            <?php foreach ($tables as $table): ?>
                <tr>
                    <td><?=$table->getName()?></td>
                    <td>
                    <a href="<?= $router->url("admin_table_edit",['table'=>$table->getName()])?>" class="button">Editer</a>
                    <form action="<?= $router->url("admin_table_delete",['table'=>$table->getName()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                    </form>                    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

