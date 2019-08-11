function CheckInputs() {

    var inputs = new Array();

    $("#registration-form-2 :input").each(function(){
        inputs.push($(this));
    });

    console.log(inputs);

    if (document.forms['form'].fname.value === "" ||
        document.forms['form'].lname.value === "" ||
        document.forms['form'].birthday.value === "" ||
        document.forms['form'].address.value === "" ||
        document.forms['form'].zip.value === "" ||
        document.forms['form'].city.value === "" ||
        document.forms['form'].mobile.value === "" ||
        document.forms['form'].mail.value === "" ||
        document.forms['form'].nb_inscrit.value === "") {
        alert("Certains champs obligatoires n'ont pas été remplis.");
        return false;
    }
    else if (!document.forms["form"].birthday.value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/g)) {
        alert("La saisie de la date de naissance est invalide. Veuillez inscrire la date de naissance au format suivant : JJ/MM/AAAA");
        return false;
    }
    else if (!document.forms["form"].mail.value.match(/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/)) {
        alert("Le format de l'adresse mail est incorrecte.");
        return false;
    }
    else if (document.forms["form"].mobile.value.length != 10) {
        alert("Le numéro de téléphone portable nécessite 10 chiffres.");
        return false;
    }
    else if (document.forms["form"].phone.value.length > 0 && document.forms["form"].phone.value.length != 10) {
        alert("Le numéro de téléphone fixe nécessite 10 chiffres.");
        return false;
    }
    else if (document.forms['form'].revenu_fiscal.value.length != "") {
        if (parseFloat(document.forms['form'].revenu_fiscal.value) < 0) {
            alert("Le revenu fiscal de référence ne peut pas être inférieur à 0 euros.");
            return false;
        }
    }
    else if (!document.getElementById('cb1').checked && !document.getElementById('cb2').checked &&
        !document.getElementById('cb3').checked && !document.getElementById('cb4').checked) {
        alert("Au moins une personne doit être inscrite.");
        return false;
    }
    else if (document.forms['form'].nb_inscrit.value != "") {
        var val = parseFloat(document.forms['form'].nb_inscrit.value);
        if (val != Math.round(val)) {
            alert("Le nombre de personnes inscrites doit être un nombre entier.");
            return false;
        }
        else if (val <= 0) {
            alert("Il ne peut y avoir moins d'une personne inscrite.");
            return false;
        }
    }

    return true;
}

// Birthdate format
$.validator.addMethod("dateFormat",function(value, element) {
        return value.match(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/);
},"Merci de saisir votre date de naissance. Format dd/mm/aaaa");

// Phone number format
$.validator.addMethod("phoneFormat",function(value, element) {
    return value.match(/0[1-9]\d{8}/);
},"Merci de saisir un bon numéro de télphone.");

jQuery(document).ready(function($){
    $("#registration-form-2").validate({
        rules: {
            field: {
                required: true
            },
            birthday: {
                required: true,
                dateFormat: true
            },
            mobile: {
                phoneFormat: true,
                minlength: 10,
                maxlength: 10
            },
            'registration_options[]' : {
                required: true
            },
            confirm_email : {
                equalTo: '#email'
            }

        },
        messages: {
            field: {
                required: 'Ce champs est requis'
            },
            mobile: {
                minlength: 'Merci de saisir un bon numéro de télphone',
                maxlength: 'Merci de saisir un bon numéro de télphone'
            },
            'registration_options[]': {
                required: 'Merci de choisir au moins une option'
            },
            confirm_email : {
                equalTo: 'Merci de saisir la même adresse mail'
            }
        }
    });
});

