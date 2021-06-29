<?php

use App\Connection;
use App\Table\PriceTable;
use App\HTML\HTMLForm;
use App\Model\Price;
use App\ObjectHelper;
use App\Table\ConfigTable;
use App\Table\PriceSectionTable;
use App\Validators\PriceValidator;

$title = "Gestion tarifs | Colambe";

$pdo = Connection::getPDO();
$configTable = new ConfigTable($pdo);
$pricetypes = $configTable->list(PRICETYPE);

$pricesectionTable = new PriceSectionTable($pdo);
$pricesections = $pricesectionTable->list();

$price = new Price();

// if (is_null($price->getPricetypeId())) {
//     $price->setPricetype("");
// } else {
//     $price->setPricetype($pricetypes[$price->getPricetypeId()]);
// }


$errors = [];
   
if(!empty($_POST)) {
    $priceTable = new PriceTable($pdo);
    $v = new PriceValidator($_POST, $priceTable, $price->getId());
    if ($_POST['price'] == "") {
        $_POST['price'] = null;
    }
    if ($_POST['pricetype_id'] == "") $_POST['pricetype_id'] = null;
    ObjectHelper::hydrate($price, $_POST, ['name', 'text', 'price', 'pricesection_id', 'pricetype_id']);
    $validation = $v->validate();
    
    if ($validation) {
        $priceTable->insertPrice($price);
        header("Location:" . $router->url('admin_prices') .'?create=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($price, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Création d'un tarif</h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">Le tarif n'a pas pu être créé</div>
    <?php endif ?>

    <?php require('_form.php') ?>

</article>