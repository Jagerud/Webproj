<?php
session_save_path('session');
//session_save_path("../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include_once 'includes/functions.php';
include 'includes/navbar.php';
?>

<h1>Success!</h1>
<p>Go to the  <a href="index.php">login page</a> and log in</p>
<?php include("includes/scripts.php"); ?>
</body>
</html>