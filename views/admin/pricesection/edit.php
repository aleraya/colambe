<?php

use App\Connection;
use App\Table\PriceSectionTable;
use App\HTML\HTMLForm;
use App\ObjectHelper;
use App\Upload;
use App\Validators\PriceSectionValidator;

$title = "Gestion événement | Colambe";

$pdo = Connection::getPDO();
$pricesectionTable = new PriceSectionTable($pdo);
$pricesection = $pricesectionTable->find($params['id']);

$errors = [];
   
if(!empty($_POST)) {
    $v = new PriceSectionValidator($_POST, $pricesectionTable, $pricesection->getId());
    $_POST['order_nb'] = (int)$_POST['order_nb'];
    ObjectHelper::hydrate($pricesection, $_POST, ['name', 'order_nb']);
    $validation = $v->validate();

    if ($validation) {
        $pricesectionTable->updatePriceSection($pricesection);
        header("Location:" . $router->url('admin_pricesections') .'?update=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($pricesection, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion de la rubrique <?= e($pricesection->getName())?></h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">La rubrique n'a pas pu être modifiée</div>
    <?php endif ?>

    <?php require('_form.php') ?>

</article>