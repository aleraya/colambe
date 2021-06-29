<?php

use App\Connection;
use App\Table\EventTable;
use App\HTML\HTMLForm;
use App\ObjectHelper;
use App\Upload;
use App\Validators\EventValidator;

$title = "Gestion événement | Colambe";

$pdo = Connection::getPDO();
$eventTable = new EventTable($pdo);
$event = $eventTable->find($params['id']);

$errors = [];
   
if(!empty($_POST)) {
    $v = new EventValidator($_POST, $eventTable, $event->getId());
    $_POST['order_nb'] = (int)$_POST['order_nb'];
    ObjectHelper::hydrate($event, $_POST, ['name', 'date', 'place', 'fb_url', 'order_nb']);
    $validation = $v->validate();
    
    if (isset($_POST['delete'])) {
        $event->setPicture('');
    }

    if ($_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE) {
        try {
            $uploader = new Upload(EVENT_PATH);
            if (!isset($_POST['picture'])) {
                $fileName = $uploader->upload($_FILES['img']);   
            } else {
                $fileName = $uploader->upload($_FILES['img'], $_POST['picture']);   
            }
            $event->setPicture($fileName);
        } catch(Exception $e) {
            $errors['img'][0] = $e->getMessage();
            $validation = false;
        }
    }

    if ($validation) {
        $eventTable->updateEvent($event);
        if ($_FILES['img']['error'] === UPLOAD_ERR_NO_FILE && isset($_POST['delete']) && isset($_POST['picture'])) {
            $uploader = new Upload(EVENT_PATH);
            $uploader->delete($_POST['picture']);
        }
        header("Location:" . $router->url('admin_events') .'?update=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new HTMLForm($event, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion de l'événement <?= htmlentities($event->getName())?></h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">L'événement n'a pas pu être modifié</div>
    <?php endif ?>

    <?php require('_form.php') ?>

</article>