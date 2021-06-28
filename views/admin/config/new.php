<?php

use App\Connection;
use App\Table\ConfigTable;
use App\HTML\HTMLForm;
use App\Model\Config;
use App\ObjectHelper;
use App\Validators\ConfigValidator;


$createNewTable = !isset($params['table']);

if ($createNewTable) {
    $title = "Création table | Colambe";
    $prestationTitle = "Création d'une table";
    $prestationError = "La table n'a pas pu être créée";
} else {
    $title = "Création enregistrement table | Colambe";
    $prestationTitle = "Création enregistremet dans la table {$params['table']}";
    $prestationError = "L'enregistrement n'a pas pu être créé";
}

$config = new Config();

if(isset($params['table'])) {
    $config->setName($params['table']);
}

$errors = [];
   
if(!empty($_POST)) {
    $pdo = Connection::getPDO();
    $configTable = new ConfigTable($pdo); 
    $v = new ConfigValidator($_POST, $configTable, $createNewTable, $config->getId());
    ObjectHelper::hydrate($config, $_POST, ['name', 'code', 'value']);
    $validation = $v->validate();

    if ($validation) {
        $configTable->insertConfig($config);
        if ($createNewTable) {
            header("Location:" . $router->url('admin_tables') .'?create=1');
            //header("Location:" . $router->url('admin_event', ['id'=>$event->getId()]) . '?created=1');
        } else {
            header("Location:" . $router->url("admin_table_edit",['table'=>$config->getName()]) .'?create=1');
        }
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
} 



$form = new HTMLForm($config, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'><?=$prestationTitle?></h1>  
    <?php if(!empty($errors)): ?>
        <div class="error"><?=$prestationError?></div>
    <?php endif ?>

    <?php require('_form.php') ?>
</article>