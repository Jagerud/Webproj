<?php
session_save_path("../../Documents/session");
session_start();
// inget ficxat mest för test
//sec_session_start();
//include("includes/db.php");
//include_once 'includes/db.php';
//include_once 'includes/functions.php';
//include ("includes/register.inc.php");
//include ("includes/process_login.php");
include("includes/functions.php");
include 'includes/navbar.php';
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
$_SESSION["favcolor"] = "green";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Secure Login: Log In</title>
    <link rel="stylesheet" href="css/stylesheet.css"/>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
</head>
<body>
<div class="container">
    <div class="myheader"><h1>Sann Pizza</h1></div>
    <form action="includes/process_login.php" method="post" name="login_form">
        <div class="emailField"> Email: <input type="text" name="email"/></div>
        <div class="passwordField">Password: <input type="password"
                                                    name="password"
                                                    id="password"/></div>
        <div class="passwordButton"><input type="button"
               value="Login"
               onclick="formhash(this.form, this.form.password);"/></div>

    </form>
    <!-- Inspiration ifrån tidigare arbete på lab 3 -->
    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <a href="img/pizza.jpg" data-lightbox="Sann Pizza" data-title="Pizza!"><img class="thumbnail"
                                                                                        src="img/pizza2.jpg"
                                                                                        alt="Filip"></a></div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <a href="img/kebab.jpg" data-lightbox="Sann Pizza" data-title="Grillat!"><img class="thumbnail"
                                                                                          src="img/kebab2.jpg"
                                                                                          alt="Filip"></a></div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <a href="img/flagga.jpg" data-lightbox="Sann Pizza" data-title="Italienskt!"><img class="thumbnail"
                                                                                              src="img/flagga2.jpg"
                                                                                              alt="Filip"></a></div>
    </div>

    <div class="pizzas">
        <p>
            1 Vesuvio 65kr
        </p>
        <p>
            2 Capriciosa 70kr
        </p>
        <p>
            3 Kebabpizza 75kr
        </p>
    </div>
    <?php
    if (isset($_GET['error'])) {
        echo '<p class="error">Error Logging In!</p>';
    }
    ?>

    <?php
    echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
    ?>
    </div>
    <?php include("includes/scripts.php"); ?>
</body>
</html>
