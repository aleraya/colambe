<?php

use App\Connection;
use App\Table\SlotTable;
use App\HTML\HTMLForm;
use App\Model\Slot;
use App\ObjectHelper;
use App\Table\ConfigTable;
use App\Validators\SlotValidator;

$title = "Gestion créneau | Colambe";

$pdo = Connection::getPDO();
$configTable = new ConfigTable($pdo);
$days = $configTable->list(DAY);

$slot = new Slot();

$errors = [];
   
if(!empty($_POST)) {
    $slotTable = new SlotTable($pdo); 
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
        $slotTable->insertSlot($slot);
        header("Location:" . $router->url('admin_slots') .'?create=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($slot, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Création d'un créneau</h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">Le créneau n'a pas pu être créé</div>
    <?php endif ?>

    <?php require('_form.php') ?>

</article>