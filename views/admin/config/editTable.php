<?php

use App\Auth;
use App\Connection;
use App\Table\ConfigTable;

Auth::check();

$table =  $params['table']; 
$title = "Administration table {$table}| Colambe";
$pdo = Connection::getPDO();

$configTable = new ConfigTable($pdo);
$fields = $configTable->findAllOfTable($table);
?>

<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion de la table <?=$table?></h1>
    <?php if(isset($_GET['create'])): ?>
        <div class="valid">L'enregistrement a bien été créé</div>
    <?php endif; ?>
    <?php if(isset($_GET['update'])): ?>
        <div class="valid">L'enregistrement a bien été modifié</div>
    <?php endif; ?>
    <?php if(isset($_GET['delete'])): ?>
        <div class="valid">L'enregistrement a bien été supprimé</div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Code</th>
            <th>Valeur</th>
            <th><a href="<?= $router->url("admin_table_newTable", ['table'=>$table])?>" class="button">Créer</a></th>
        </thead>
        <tbody>
            <?php foreach ($fields as $field): ?>
                <tr>
                    <td><?=$field->getId()?></td>
                    <td><?=$field->getCode()?></td>
                    <td><?=$field->getValue()?></td>
                    <td>
                    <a href="<?= $router->url("admin_table_editTable",['table'=>$table, 'id'=>$field->getId()])?>" class="button">Editer</a>
                    <form action="<?= $router->url("admin_table_deleteTable",['table'=>$table,'id'=>$field->getId()])?>" method="post" onsubmit="return confirm('Confirmez-vous la suppression ?')" style="display:inline">
                            <button type="submit">Supprimer</button>
                    </form>                    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= $router->url("admin_tables")?>" class="button">Retour</a>
</article>

