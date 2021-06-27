<?php

use App\Connection;
use App\HTML\HTMLForm;
use App\HTML\HTMLTable;
use App\Model\Contact;
use App\ObjectHelper;

session_start();

$title = "Contact | Colambe";
$pdo = Connection::getPDO();


$success= false;
if (isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$errors = [];
$contact = new Contact();

if(array_key_exists('errors', $_SESSION)) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
if(array_key_exists('$_POST', $_SESSION)) {
    ObjectHelper::hydrate($contact, $_SESSION['$_POST'], ['name', 'firstName', 'email', 'tel', 'message']);
    unset($_SESSION['$_POST']);
}

$form = new HTMLForm($contact, $errors, false);
$table = new HTMLTable($pdo);
?>

<h1 class='prestation-title'>Contact</h1>

<!-- Insertion carte : maps.google.com, saisir adresse, partager, intégrer copie lien html-->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2700.131202396085!2d-1.3833950838945137!3d47.409381979172075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805ff187ae619f5%3A0xbd05516827847b87!2s80%20Avenue%20Ravel%2C%2044850%20Lign%C3%A9!5e0!3m2!1sfr!2sfr!4v1601827475786!5m2!1sfr!2sfr" width="1200" height="350" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
<div class="contact">
    <div class="contact__bloc">
        <h2 class="contact__title">Mes coordonnées</h2>
        <address class="txtcenter">
            Anne LERAY <br> 
            80 avenue Ravel <br> 
            44850 LIGNE <br>
            Tel : 06-52-70-86-37
        </address>
        <p class="txtcenter">Massages à domicile (dans un rayon de 30km)</p>
        <p class="txtcenter">Uniquement sur rendez-vous</p>
        <div class="logo-fb">
            <a href="https://www.facebook.com/colambe" target= '_blank'><img src="webroot/img/facebook.png" alt="Logo facebook" height="32" width="32"></a>                
        </div>
        <table class="contact__table"> 
            <tr>
                <td colspan="2"><h2 class="contact__title">Horaires d'ouverture </h2></td>
            </tr>
            <?= $table->displayTableSlot()?>
        </table>
    </div>

    <div class="contact__bloc">
        <h2 class="contact__title">Contactez-moi</h2>
        <div class="contact__form valid">
            <?php if ($success): ?>
                Votre message a bien été envoyé.
            <?php endif; ?>
        </div>
        <form class="contact__form" enctype="multipart/form-data" action="post_contact" name="send" id="send" method="POST">
            <?= $form->input('name', 'Nom', true);?>
            <?= $form->input('firstName', 'Prénom', true);?>
            <?= $form->input('email', 'E-mail', true);?>
            <?= $form->input('tel', 'Tél.', true);?>
            <?= $form->textarea('message', 'Message', true);?>
            <button type="submit" >Envoyer</button>
        </form>
    </div>

</div>

