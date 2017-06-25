<?php
//session_save_path("../../Documents/session"); //ida
session_save_path("session");
session_start();
//include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

include 'includes/navbar.php';
echo "Favorite color is " . $_SESSION["favcolor"];
//INTE FIXAT BARA TEST
 
//sec_session_start();



?>
<!--DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="css/stylesheet.css.css" />
    </head>
    <body-->
        <?php
        if (login_check($mysqli) == true) :

            ?>
            <p>Welcome <?php echo htmlentities($_SESSION['email']); ?>!</p>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.
            </p>
            <p>Return to <a href="index.php">login page</a></p>
            <p><a href="includes/logout.php">Log out</a></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.


            </p>
        <?php endif; ?>
<?php include("includes/scripts.php"); ?>
    </body>
</html>
