<?php

use App\Connection;
use App\Table\SlotTable;
use App\HTML\HTMLForm;
use App\ObjectHelper;
use App\Table\ConfigTable;
use App\Validators\SlotValidator;

$title = "Gestion créneau | Colambe";

$pdo = Connection::getPDO();
$slotTable = new SlotTable($pdo);
$configTable = new ConfigTable($pdo);

$slot = $slotTable->find($params['id']);
$days = $configTable->list(DAY);
$slot->setDayname($days[$slot->getDay()]);

$errors = [];
   
if(!empty($_POST)) {
    $v = new SlotValidator($_POST, $slotTable, $slot->getId());
    ObjectHelper::hydrate($slot, $_POST, ['day', 'start_time', 'end_time']);
    $validation = $v->validate();
    
    if ($validation) {
        if ($slotTable->isOverlap($slot->getDay(), $slot->getStartTimeToDateTime(), $slot->getEndTimeToDateTime(), $slot->getId())) {
            $errors['start_time'][0] = 'Ce créneau chevauche un créneau existant';
            $errors['end_time'][0] = 'Ce créneau chevauche un créneau existant';
            $validation = false;
        }
    }

    if ($validation) {
        $slotTable->updateSlot($slot);
        header("Location:" . $router->url('admin_slots') .'?update=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($slot, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion du créneau sur la journée de <?= e($slot->getDayname())?></h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">Le créneau n'a pas pu être modifié</div>
    <?php endif ?>

    <?php require('_form.php') ?>

</article>