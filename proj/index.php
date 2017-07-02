<?php
session_save_path('session');
//session_save_path("../../Documents/session");
session_start();
include("includes/functions.php");
include 'includes/navbar.php';
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
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
<!--
    <form action="includes/process_login.php" method="POST">
        <input type="text" name="texten">
        <input type="submit" name="submiten">
    </form>


    <form class="navbar-form" action="includes/process_login.php" method="post"
          name="testForm">
        <!-- Kunna söka efter pizzor på sidan// INTE IMPLEMENTERAD -->


<!--

        <div class="row">

            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" name="testEmail"
                           placeholder="testEmail...">
                    <input type="password" class="form-control" name="testPassword"
                           id="testPassword"
                           placeholder="testPassword...">
                                            <span class="input-group-btn">
				                                <button class="btn btn-default" type="submit" value="submit"  name="submit">-></button>
                                            </span>
                </div><!-- /input-group ->
            </div><!-- /.col-lg-6 ->
        </div><!-- /.row ->
    </form>
-->
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
