<?php
//session_save_path("../../../Documents/session"); //ida
session_save_path("../session");
session_start();
//sec_session_start();
//include 'db.php';
include 'functions.php';
echo "Favorite color is " . $_SESSION["favcolor"];
?>
<!--DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Login: Protected Page</title>
    <link rel="stylesheet" href="css/stylesheet.css.css" />
</head>
<body-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--<meta name="Sann Pizza" content="Ett smart pizza system!"> -->
    <meta name="description" content="Sann Pizza, Ett smart pizza-system!">
    <meta name="keywords" content="Pizza, smart, , Filip Jägerud, jaegerud, jagerud, jaeger">
    <meta name="author" content="Filip Jägerud">
    <title>Sann Pizza Logged In</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/lightbox.css">

</head>
<body>
<?php
foreach ($_POST as $key => $value){
    echo "{$key} = {$value}\r\n";
}


    echo "login  är: " . $_POST['loginButton'];

//sec_session_start(); //kallar på min säkra metod, session fungerar inte

    echo "email är: " . $_POST['email'];
if(isset($_POST['p'])){
    echo "p är: " . $_POST['p   '];
}
echo "<br>ingen av dom?!<br>";
if (isset($_POST['email'], $_POST['p'])) {  //om de inte är null
    //echo " krypterat " . $_POST['p'] . "<br>";
    $email = $_POST['email'];
    $password = $_POST['p']; // krypterade lösenordet
    echo $email;
    //$_COOKIE['pnew'] = $password; //Funkar inte med cookies?
    //$_COOKIE['mail'] = $email;
    if (login($email, $password, $mysqli) == true) : // inloggad
        $_SESSION['email'] = $email;
        header('Location: ../protected_page.php');
        ?>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Menu <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false"><?php echo htmlentities($email); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li>
                                    <form class="navbar-form" role="search">
                                        <!-- Kunna söka efter pizzor på sidan// INTE IMPLEMENTERAD -->
                                        <form id="form1" method="post">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="input-group">

                                                        <input type="text" class="form-control" name="name"
                                                               placeholder="Användare...">
                                                        <input type="text" class="form-control" name="pass"
                                                               placeholder="Lösenord...">
                                                        <span class="input-group-btn">
				        <button class="btn btn-default" type="submit" name="submit">></button>
				      </span>
                                                    </div><!-- /input-group -->
                                                </div><!-- /.col-lg-6 -->
                                            </div><!-- /.row -->
                                        </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <h2>Welcome <?php echo htmlentities($email); ?>!</h2>
        <p>
            This is your own page where you can save your favourite pizza.
        </p>
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a href="../img/pizza.jpg" data-lightbox="Sann Pizza" data-title="Pizza!"><img class="thumbnail"
                                                                                               src="../img/pizza2.jpg"
                                                                                               alt="Pizza"></a></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a href="../img/kebab.jpg" data-lightbox="Sann Pizza" data-title="Grillat!"><img class="thumbnail"
                                                                                                 src="../img/kebab2.jpg"
                                                                                                 alt="Kebab"></a></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <a href="../img/flagga.jpg" data-lightbox="Sann Pizza" data-title="Italienskt!"><img class="thumbnail"
                                                                                                     src="../img/flagga2.jpg"
                                                                                                     alt="Italy"></a>
            </div>
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
        </div
        <p>Return to <a href="../index.php">login page</a></p>
    <?php else : ?>
        <p>
            <span class="error">You are not authorized to access this page.</span> Please <a
                href="../index.php">login</a>.
        </p>
    <?php endif; ?>


    <?php //header('Location: ../protected_page.php');
    /*} else {                                           // misslyckades

        //header('Location: ../index.php?error=1');
        header("Location: ../error.php?error=Något gick fel vid kontroll av uppgifter "); //$mysqli
        echo "snopp";
    }*/
} else {

    echo 'Invalid Request, must be logged in to see this page!.</span> Please <a href="../index.php">login</a>.'; //POST skickade fel
}
include 'scripts.php';
?>

</body>
</html>
