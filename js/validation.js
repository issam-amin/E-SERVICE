/*
function validarFormLogin(formulaire) {
    // Expression régulière pour valider le nom, le prénom et l'e-mail
    var expRegNom = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    var expRegPrenom = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
    var expRegEmail = /^\w+@(\w+\.)+\w{2,4}$/;

    // Valider l'e-mail
    var email = formulaire.email;

    if (email.value === "") {
        alert("Veuillez fournir une adresse e-mail valide");
        email.focus();
        email.select();
        return false;
    }

    if (!expRegEmail.exec(email.value)) {
        alert("Veuillez fournir une adresse e-mail valide");
        email.focus();
        email.select();
        return false;
    }

    // Valider le mot de passe
    var password = formulaire.password;
    /!*if (password.value === "" || password.value.length < 8) {
        alert("Veuillez fournir un mot de passe d'au moins 8 caractères");
        password.focus();
        password.select();
        return false;
    }*!/

    /!*if (!checkPassword(password.value)) {
        alert("Le mot de passe doit contenir entre 8 et 16 caractères, au moins un chiffre, une minuscule et une majuscule. Il ne peut pas contenir d'autres symboles");
        password.focus();
        password.select();
        return false;
    }*!/

    // Formulaire validé
    alert("Bienvenue " + email.value);
    return true;
}


function checkPassword(value) {
    var expRegPassword = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if (expRegPassword.test(value)) {
        //alert(value+" est valide");
        return true;
    } else {
        //alert(value+" n'est pas valide");
        return false;
    }
}

function infoNom() {
    alert("Champ Nom : N'accepte pas les valeurs numériques");
}

function infoEmail() {
    alert("Champ Email : N'accepte pas les adresses e-mail sans @");
}

function infoPassword() {
    alert("Le mot de passe doit contenir entre 8 et 16 caractères, au moins un chiffre, une minuscule et une majuscule. Il ne peut pas contenir d'autres symboles");
}
*/
