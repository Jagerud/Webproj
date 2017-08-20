<?php
//klar
session_save_path('session');
//session_save_path("../../Documents/session");
session_start();
include("includes/functions.php");
include 'includes/navbar.php';

if (login_check($mysqli) == true) { //kollar om inloggad
    $logged = 'in';
    $loggedIn = true;
} else {
    $logged = 'out';
    $loggedIn = false;
}
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

    if($loggedIn){
        echo "<p>You are our most well liked user!</p>";
    }
    else {
        echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";
    }

    ?>
</div>
<?php include("includes/scripts.php"); ?>
</body>
</html>
