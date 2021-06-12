<?php
$title = "Contact | Colambe";
require VIEW_PATH. '/layouts/header.php';
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
        <form class="contact__form" action="mailto:anne.leray8@gmail.com?subject=Formulaire_d_envoi" name="envoi" method="POST" enctype="text/plain">
            <div>
                <label class="contact-label" for="name">Nom <sup>*</sup></label> <br>
                <input type="text" name="name" id="name" > 
            </div>
            <div>
                <label  class="contact-label" for="firstName">Prénom <sup>*</sup></label> <br>
                <input type="text" name="firstName" id="firstName" >    
            </div>
            <div>
                <label  class="contact-label" for="email">E-mail <sup>*</sup></label> <br>
                <input type="text" name="email" id="email" >    
            </div>
            <div>
                <label  class="contact-label" for="tel">Tél. <sup>*</sup></label> <br>
                <input type="text" name="tel" id="tel" >    
            </div>
            <div>
                <label  class="contact-label" for="message">Message <sup>*</sup></label> <br>
                <textarea name="message" id="message" ></textarea>     
            </div>
            <button class="boutton" type="submit">Envoyer</button>
        </form>
    </div>

</div>

<?php require VIEW_PATH. '/layouts/footer.php'; ?>