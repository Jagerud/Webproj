<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--<meta name="Sann Pizza" content="Ett smart pizza system!"> -->
    <meta name="description" content="Sann Pizza, Ett smart pizza-system!">
    <meta name="keywords" content="Pizza, smart, , Filip Jägerud, jaegerud, jagerud, jaeger">
    <meta name="author" content="Filip Jägerud">
    <!--title>Sann Pizza</title-->
    <!--link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../css/lightbox.css"-->

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <!link rel="shortcut icon" href="img/sun.png" > <!-- NOT IMPLEMENTED -->
</head>
<body>
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
                <li><a href="index.php">Start</a></li>
                <li><a href="#">Link</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="protected_page.php">User</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo htmlentities($_SESSION['email']); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="includes/logout.php">Log out</a></li>
                        <li role="separator" class="divider"></li>
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