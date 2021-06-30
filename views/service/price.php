<?php

use App\Connection;
use App\HTML\HTMLTable;
use App\Model\PriceSection;
use App\Table\PriceSectionTable;

$pdo = Connection::getPDO();
$priceSections = (new PriceSectionTable($pdo))->findAll();

$title = 'Tarifs | Colambe';
?>

<article class="centrage">
    <h1 class='prestation-title'>Tarifs</h1>
    <table class="table-tarif">
        <?php foreach($priceSections as $priceSection): ?>
        <tr>
            <td colspan="3"><h2 class="price__prestation-title"><?=$priceSection->getName(); ?></h2></td>
        </tr>
        <?= (new HTMLTable($pdo, $priceSection->getId()))->displayTablePrice() ;?> 
        <?php endforeach; ?>
    </table>
</article>