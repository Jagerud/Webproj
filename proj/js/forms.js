//Det mesta i detta dokument är hämtat ifrån http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL då jag inte lärt
//mig något om kryptering i skolan och simpel kontroll av inmatning kändes onödigt att ändra
// då jag förstod hur det fungerade direkt och detta fungerade även på min hemsida.


function formhash(form, password) {
    var p = document.createElement("input");

    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);   //krypterar med sha512

    //Tar bort gamla okrypterade lösenordet
    password.value = "";

    form.submit();
}

function regformhash(form, uid, email, password, conf) {
    // Kontroll så att inget fält var tomt
    if (uid.value === '' ||
        email.value === '' ||
        password.value === '' ||
        conf.value === '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }

    //färdig kontroll av användarnamnet

    re = /^\w+$/;
    if (!re.test(form.username.value)) {
        alert("Username must contain only letters, numbers and underscores. Please try again");
        form.username.focus();
        return false;
    }

    // Kollar att lösenordet är minst 6 tecken och returnerar meddelande annars.
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    // Färdig kontroll som ser till att lösenordet är minst
    // 6 tecken, minst 1 siffra samt innehåller stor och liten bokstav.

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }

    // Jämför lösenord med kontrollinmatning av lösenord
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    // Skapar en ny variabel för att hålla krypterade lösenordet.
    var p = document.createElement("input");

    // Lägger till den i formen.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Tar bort gamla okrypterade lösenordet
    password.value = "";
    conf.value = "";

    form.submit();
    return true;
}