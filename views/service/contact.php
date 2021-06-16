<?php
session_start();

$success= false;
if (isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$errors = [];
$datas  = [];
if(array_key_exists('errors', $_SESSION)) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
if(array_key_exists('$_POST', $_SESSION)) {
    $datas = $_SESSION['$_POST'];
    unset($_SESSION['$_POST']);
}

$title = "Contact | Colambe";
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
            <tr >
                <td class="contact-td">Lundi</td>
                <td class="contact-td">8h-19h</td>
            </tr>
            <tr>
                <td class="contact-td">Mardi</td>
                <td class="contact-td">8h-19h</td>
            </tr>
            <tr>
                <td class="contact-td">Mercredi</td>
                <td class="contact-td">Fermé</td>
            </tr>
            <tr>
                <td class="contact-td">Jeudi</td>
                <td class="contact-td">8h-19h</td>
            </tr>
            <tr>
                <td class="contact-td">Vendredi</td>
                <td class="contact-td">8h-19h</td>
            </tr>
            <tr>
                <td class="contact-td">Samedi</td>
                <td class="contact-td">8h-19h</td>
            </tr>
            <tr>
                <td class="contact-td">Dimanche</td>
                <td class="contact-td">Fermé</td>
            </tr>
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
            <div>
                <label class="contact-label" for="name">Nom <sup>*</sup></label> <br>
                <input type="text" name="name" id="name" value="<?=isset($datas['name'])?$datas['name']:null; ?>"> 
                <?php if(isset($errors['name'])): ?>
                    <div class="error">
                        <?= $errors['name'];?>
                    </div>
                <?php endif; ?>            
            </div>
            <div>
                <label  class="contact-label" for="firstName">Prénom <sup>*</sup></label> <br>
                <input type="text" name="firstName" id="firstName" value="<?=isset($datas['firstName'])?$datas['firstName']:null; ?>">    
                <?php if(isset($errors['firstName'])): ?>
                    <div class="error">
                        <?= $errors['firstName'];?>
                    </div>
                <?php endif; ?>            
            </div>
            <div>
                <label  class="contact-label" for="email">E-mail <sup>*</sup></label> <br>
                <input type="text" name="email" id="email" value="<?=isset($datas['email'])?$datas['email']:null; ?>">    
                <?php if(isset($errors['email'])): ?>
                    <div class="error">
                        <?= $errors['email'];?>
                    </div>
                <?php endif; ?>            
            </div>
            <div>
                <label  class="contact-label" for="tel">Tél. <sup>*</sup></label> <br>
                <input type="text" name="tel" id="tel" value="<?=isset($datas['tel'])?$datas['tel']:null; ?>">    
                <?php if(isset($errors['tel'])): ?>
                    <div class="error">
                        <?= $errors['tel'];?>
                    </div>
                <?php endif; ?>            
            </div>
            <div>
                <label  class="contact-label" for="message">Message <sup>*</sup></label> <br>
                <textarea name="message" id="message"><?=isset($datas['message'])?$datas['message']:null; ?></textarea>     
                <?php if(isset($errors['message'])): ?>
                    <div class="error">
                        <?= $errors['message'];?>
                    </div>
                <?php endif; ?>            
            </div>
            <button class="boutton" type="submit" >Envoyer</button>
        </form>
    </div>

</div>

