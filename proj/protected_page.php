<?php
session_save_path("../../Documents/session");
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
            <div class="well">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Panel heading</div>
                    <div class="panel-body">
                        <p>...</p>
                    </div>

                    <!-- Table -->
                    <table class="table">
                        ...
                    </table>
                </div>
            </div>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.


            </p>
        <?php endif; ?>
<?php include("includes/scripts.php"); ?>
    </body>
</html>
