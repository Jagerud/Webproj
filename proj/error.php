<?php
session_save_path('session');
//session_save_path("../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include_once 'includes/functions.php';
include 'includes/navbar.php';


$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (! $error) {
    $error = 'Unknown error.';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="css/stylesheet.css" />
</head>
<body>
<h1>There was an error</h1>
<p class="error"><?php echo $error; ?></p>
<p><a href='index.php'>Go back to start</a></p>
<?php include("includes/scripts.php"); ?>
</body>
</html>