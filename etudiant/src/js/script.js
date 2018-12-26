function valider(form)
{
    if(form.First_name.value == "") {
        alert("Merci d'enter votre nom !");
        exit();
    //
    }
    else if(form.Last_name.value == "")
    {
        alert("Merci d'enter votre prénom !");
        exit();
    }
    else if(form.cne.value == "")
    {
        alert("Merci d'enter votre cne !");
        exit();
    }
    else if(form.mail.value == "")
    {
        alert("Merci d'enter votre mail !");
        exit();
    }
    else if(!vermail(form.mail.value))
    {
        alert("Merci de verifier l'email !");
        exit();
    }
    else if(form.password.value == "")
    {
        alert("Merci d'enter une mot de passe !");
        exit();
    }
    else if(form.Cpassword.value == "")
    {
        alert("Merci de confirmer votre mot de passe !");
        exit();
    }
    else if(form.password.value != form.Cpassword.value)
    {
        alert("Merci de confirmer votre mot de passe correctement!");
        exit();
    }
    else if(form.level.selectedIndex == 0)
    {
        alert("Merci de choisir un niveau !");
        exit();
    }
    else if(form.option.selectedIndex == 0)
    {
        alert("Merci de choisir une filière !");
        exit();
    }
    else{form.submit();}
}

function vermail(mail)

{
    var regles = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

    if(regles.test(mail))
    {
        return(true);
    }
    else
    {
        return(false);
    }
}
function valider2(form)
{
    if(form.prenom.value == "") {
        alert("Merci d'enter votre prénom !");
        exit();
    //
    }
    else if(form.nom.value == "")
    {
        alert("Merci d'enter votre nom !");
        exit();
    }
    else if(form.email.value == "")
    {
        alert("Merci d'enter votre mail !");
        exit();
    }
    else if(!vermail(form.email.value))
    {
        alert("Merci de verifier l'email !");
        exit();
    }
    else if(form.niveau.selectedIndex == 0)
    {
        alert("Merci de choisir un niveau !");
        exit();
    }
    else if(form.filiere.selectedIndex == 0)
    {
        alert("Merci de choisir une filière !");
        exit();
    }
    else{form.submit();}
}

function vermail(mail)

{
    var regles = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

    if(regles.test(mail))
    {
        return(true);
    }
    else
    {
        return(false);
    }
}

function valider1(form)
{
    form.submit();
}

function valider1(form)
{
    form.submit();
}