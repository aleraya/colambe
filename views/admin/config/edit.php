<?php

use App\Connection;
use App\Table\ConfigTable;
use App\HTML\HTMLForm;
use App\ObjectHelper;
use App\Validators\ConfigValidator;


$table = $params['table'];
$id = $params['id'];

$title = "Gestion table " .e($table) ." | Colambe";

$pdo = Connection::getPDO();
$configTable = new ConfigTable($pdo); 
$config = $configTable->find($params['id']);
$createNewTable = false;

$errors = [];
   
if(!empty($_POST)) {
    $v = new ConfigValidator($_POST, $configTable, $createNewTable, $config->getId());
    ObjectHelper::hydrate($config, $_POST, ['name', 'code', 'value']);
    $validation = $v->validate();

    if ($validation) {
        $configTable->updateConfig($config);
        header("Location:" . $router->url("admin_table_edit",['table'=>$config->getName()]) .'?update=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
} 



$form = new HTMLForm($config, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion de l'enregistrement <?= e($config->getCode())?> de la table <?= e($config->getName())?></h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">L'enregistrement n'a pas pu être modifié</div>
    <?php endif ?>

    <?php require('_form.php') ?>
</article>