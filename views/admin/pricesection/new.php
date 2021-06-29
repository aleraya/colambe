<?php

use App\Connection;
use App\Table\PriceSectionTable;
use App\HTML\HTMLForm;
use App\Model\PriceSection;
use App\ObjectHelper;
use App\Validators\PriceSectionValidator;

$title = "Création événement | Colambe";

$pricesection = new PriceSection();

$errors = [];
   
if(!empty($_POST)) {
    $pdo = Connection::getPDO();
    $pricesectionTable = new PriceSectionTable($pdo); 
    $v = new PriceSectionValidator($_POST, $pricesectionTable, $pricesection->getId());
    $_POST['order_nb'] = (int)$_POST['order_nb'];
    ObjectHelper::hydrate($pricesection, $_POST, ['name', 'order_nb']);
    $validation = $v->validate();

    if ($validation) {
        $pricesectionTable->insertPriceSection($pricesection);
        header("Location:" . $router->url('admin_pricesections') .'?create=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($pricesection, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Création d'une rubrique de tarif</h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">La rubrique n'a pas pu être créée</div>
    <?php endif ?>

    <?php require('_form.php') ?>
</article>