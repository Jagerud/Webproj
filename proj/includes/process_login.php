<?php
session_save_path('../session');
//session_save_path("../../../Documents/session");
session_start();
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
echo $_POST['testEmail'];
echo $_POST['p'];
if (isset($_POST['email'], $_POST['p'])) {  //funkar
    echo "efter";
    $email = $_POST['email'];
    $password = $_POST['p']; // krypterade lösenordet
    if (login($email, $password, $mysqli) == true) : // inloggad
        $_SESSION['email'] = $email;
        header('Location: ../protected_page.php');
        ?>

    <?php else :
        header('Location: ../index.php');
        ?>
        <p>

            <span class="error">You are not authorized to access this page.</span> Please <a
                    href="../index.php">login</a>.
        </p>
    <?php endif; ?>


    <?php
} else {

    echo 'Invalid Request, must be logged in to see this page!.</span> Please <a href="../index.php">login</a>.'; //POST skickade fel
}
include 'scripts.php';
?>

</body>
</html>
