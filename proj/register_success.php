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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link rel="stylesheet" href="styles/main.css" />
</head>
<body>
<h1>Success!</h1>
<p>Go to the  <a href="index.php">login page</a> and log in</p>
<?php include("includes/scripts.php"); ?>
</body>
</html>