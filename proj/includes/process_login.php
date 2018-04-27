<?php
//klar
session_save_path('../session');
//session_save_path("../../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include 'functions.php';
?>
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
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // krypterade lösenordet
    if (login($email, $password, $mysqli) == true) : // inloggad
        $_SESSION['email'] = $email;
        header('Location: ../favourite.php');
        ?>

    <?php else :

        //header('Location: ../index.php?error=1');
        //ful sida just nu, förbättringspotential
        ?>
        <p>

            <span class="error">Wrong password or you are not authorized to access this page.</span> Please <a
                    href="../index.php">login</a>.
        </p>
    <?php endif; ?>

    <?php
} else {

    echo 'Invalid Request, you must be logged in to see this page!. Please <a href="../index.php">login</a>.'; //POST skickade fel
}
include 'scripts.php';
?>

</body>
</html>
