<?php

use App\Connection;
use App\Table\EventTable;
use Valitron\Validator;
use App\HTML\Form;
use App\Upload;

$title = "Gestion événement | Colambe";

$pdo = Connection::getPDO();
$eventTable = new EventTable($pdo);
$event = $eventTable->find($params['id']);
$success = false;

$errors = [];
   
if(!empty($_POST)) {
    Validator::lang('fr');
    $v = new Validator($_POST);
    $v->labels(array(
        'name' => 'Le champs événement'//,
        //'email' => 'Email address'
    ));
    $v->rule('required', ['name', 'date', 'place']);
    $v->rule('lengthMin', ['name', 'date', 'place'], 3);
    //$v->rule('required', ['name', 'email']);
    //$v->rule('email', 'email');
    $event->setName($_POST['name']);
    $event->setDate($_POST['date']);
    $event->setPlace($_POST['place']);
    $event->setFbUrl($_POST['fb_url']);
    $event->setOrderNb($_POST['order_nb']);
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
        $eventTable->update($event);
        $success = true;
    } else {
        $errors = array_merge($v->errors(), $errors);
    }
}

$form = new Form($event, $errors);
?>
<article class='l-main__detail'>
    <h1 class='prestation-title'>Gestion de l'événement <?= htmlentities($event->getName())?></h1>  
    <?php if($success): ?>
        <div class="valid">L'événement a bien été modifié</div>
    <?php endif; ?>
    <?php if(!empty($errors)): ?>
        <div class="error">L'article n'a pas pu être modifié</div>
    <?php endif ?>


    <form action="" method='post' enctype="multipart/form-data">
        <?= $form->input('name', 'Evénement', true); ?>
        <?= $form->input('date', 'Date de l\'événement', true); ?>
        <?= $form->input('place', 'Lieu de l\'événement', true); ?>
        <?= $form->input('fb_url', 'Lien facebook'); ?>
        <?= $form->file('img', 'Nouvelle photo', false, 'picture', 'Photo de l\'événement'); ?> 
        <?= $form->input('order_nb', 'N°ordre d\'affichage'); ?>

        <button>Modifier</button>
    </form>
</article>