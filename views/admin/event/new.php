<?php

use App\Connection;
use App\Table\EventTable;
use App\HTML\Form;
use App\Model\Event;
use App\ObjectHelper;
use App\Upload;
use App\Validators\EventValidator;

$title = "Création événement | Colambe";

$event = new Event();

$errors = [];
   
if(!empty($_POST)) {
    $pdo = Connection::getPDO();
    $eventTable = new EventTable($pdo); 
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
        $eventTable->create($event);
        header("Location:" . $router->url('admin_events') .'?create=1');
        //header("Location:" . $router->url('admin_event', ['id'=>$event->getId()]) . '?created=1');
        exit();
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new Form($event, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Création d'un événement</h1>  
    <?php if(!empty($errors)): ?>
        <div class="error">L'événement n'a pas pu être créé</div>
    <?php endif ?>

    <?php require('_form.php') ?>
</article>