let iconMenu = document.querySelector(".l-nav-mobile");
let menu = document.querySelector(".l-nav");


iconMenu.addEventListener('click', (e) =>{
    e.preventDefault;
    menu.classList.toggle('is-open');
    iconMenu.classList.toggle('is-open');
})




function sendMail() {
    /* Tester les donnees */
    if (document.getElementById("nom").value.length==0) {
        alert("Nom obligatoire");
        return;
    }
    if (document.getElementById("prenom").value.length==0) {
        alert("Prénom obligatoire");
        return;
    }
    if (document.getElementById("email").value.length==0) {
        alert("Email obligatoire");
        return;
    }
    if (document.getElementById("tel").value.length==0) {
        alert("Téléphone obligatoire");
        return;
    }
    if (document.getElementById("message").value.length==0) {
        alert("Message obligatoire");
        return;
    }
    /* Encoder l'url mailto */
    var url="mailto:"+encodeURIComponent(document.getElementById("nom").value)
        +"?subject=" 
        "Message de : " + encodeURIComponent(document.getElementById("nom").value)
        + " "           + encodeURIComponent(document.getElementById("prenom").value) 
        +"&body="+
        "Message : " + encodeURIComponent(document.getElementById("message").value)
        +"; Mail : "    + encodeURIComponent(document.getElementById("email").value)
        ;
    /* Ouvrir client messagerie */
    document.location=url;
}
