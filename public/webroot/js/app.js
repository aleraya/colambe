/* Variables pour gestion affichage du menu mobile */
let iconMenu = document.querySelector(".l-nav-mobile");
let menu = document.querySelector(".l-nav");
/* Variables pour gestion du formulaire de contact*/
let form = document.querySelector(".contact__form");


iconMenu.addEventListener('click', (e) =>{
    e.preventDefault;
    menu.classList.toggle('is-open');
    iconMenu.classList.toggle('is-open');
})



// form.addEventListener('submit', (e) =>{
//     e.preventDefault();
//     sendMail();
// });


const sendMail =function () {
    let boValid = true;
    let spans = document.querySelectorAll(".contact__form .error");
    console.log(spans);

    /* Supprimer les éventuels messages d'erreur des précédents passages */
    for(span of spans) {
        span.parentNode.removeChild(span);
    }    
    


    /* Tester les donnees */
    /* (form.name.value) equivalent à document.getElementById("name").value); */
    if (form.name.value.trim().length==0) {
        writeMessage(form.name, "Nom obligatoire");
        boValid=false;
    } else if (form.name.value.trim().length < 2 || form.name.value.trim().length > 30 ) {
        writeMessage(form.name, "Le nom doit avoir entre 2 et 30 caractères");
        boValid=false;
    }

    if (form.firstName.value.trim().length==0) {
        writeMessage(form.firstName, "Prénom obligatoire");
        boValid=false;
    } else if (form.firstName.value.trim().length < 2 || form.firstName.value.trim().length > 30 ) {
        writeMessage(form.firstName, "Le prénom doit avoir entre 2 et 30 caractères");
        boValid=false;
    }

    if (form.email.value.trim().length==0) {
        writeMessage(form.email, "Email obligatoire");
        boValid=false;
    } else {
        // Autre test possible : let emailRegexp = new RegExp(/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i);
        let emailRegexp = new RegExp('^[a-zA-Z0-9.\\-_]+[@][a-zA-Z0-9.\\-_]+[.]{1}[a-z]{2,10}$');
        if (!emailRegexp.test(form.email.value.trim())) {
            writeMessage(form.email, "Email invalide");
            boValid=false;
        }
    }

    if (form.tel.value.trim().length==0) {
        writeMessage(form.tel, "Téléphone obligatoire");
        boValid=false;
    } else {
        let telRegexp = new RegExp('^(0|\\+33)[1-9]([-. ]?[0-9]{2}){4}$');
        if (!telRegexp.test(form.tel.value.trim())) {
            writeMessage(form.tel, "N° téléphone invalide");
            boValid=false;
        }
    }

    if (form.message.value.trim().length==0) {
        writeMessage(form.message, "Message obligatoire");
        boValid=false;
    } else if (form.message.value.trim().length < 3) {
        writeMessage(form.message, "Le message doit avoir au moins 3 caractères");
        boValid=false;
    }

    if (boValid) {
        document.getElementById("send").submit();
        /* Encoder l'url mailto */
        // var url="mailto:"+encod  eURIComponent('anne.leray8@gmail.com')
        //     +"?subject=" 
        //     "Message de : " + encodeURIComponent(form.name.value.trim())
        //     + " "           + encodeURIComponent(form.firstName.value.trim()) 
        //     +"&body="+
        //     "Message : " + encodeURIComponent(form.message.value.trim())
        //     +"; Mail : "    + encodeURIComponent(form.email.value.trim())
        //     ;
        /* Ouvrir client messagerie */
        // document.location=url;
    }
}

const writeMessage = function (element, message)  {
    let br = document.createElement('br');
    let span = document.createElement('span');
    let parent = element.parentElement;
    span.className = 'error';
    span.innerHTML = message;
    parent.appendChild(span);
    
} 

