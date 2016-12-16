<?php



$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'An unknown error happened.';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Error</title>
        <link rel="stylesheet" href="css/stylesheet.css" />
    </head>
    <body>
        <h1>There was a problem</h1>
        <p class="error"><?php echo $error; ?></p>
        <p><a href='index.php'>Return to start</a></p>

    </body>
</html>