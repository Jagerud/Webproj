<?php
	include("includes/db.php"); //inlogg till databas ---- kolla att den funkar!
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!--<meta name="Sann Pizza" content="Ett smart pizza system!"> -->
		<meta name="description" content="Sann Pizza, Ett smart pizza-system!">
		<meta name="keywords" content="Pizza, smart, , Filip Jägerud, jaegerud, jagerud, jaeger">
		<meta name="author" content="Filip Jägerud">
        <title>Sann Pizza</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/stylesheet.css">
		<link rel="stylesheet" href="css/lightbox.css">
		<link rel="shortcut icon" href="img/sun.png" > <!-- NOT IMPLEMENTED -->
	</head>
	<body>

		<?php 	include("includes/navbar.php"); ?>
		
		<div class="container">
			<div class="myheader"><h1>Sann Pizza</h1></div>

			<!-- Inspiration ifrån tidigare arbete på lab 3 -->
			<div class="row">
	          
	          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	           <a href="img/pizza.jpg" data-lightbox="Sann Pizza" data-title="Pizza!"><img class="thumbnail" src="img/pizza2.jpg" alt="Filip"></a></div>
	          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	           <a href="img/kebab.jpg" data-lightbox="Sann Pizza" data-title="Grillat!"><img class="thumbnail" src="img/kebab2.jpg" alt="Filip"></a></div>
	          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
	           <a href="img/flagga.jpg" data-lightbox="Sann Pizza" data-title="Italienskt!"><img class="thumbnail" src="img/flagga2.jpg" alt="Filip"></a></div>
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
                </div>
			<?php 	include("includes/scripts.php"); ?> <!-- Scripts och trademark-->
		</div>
		
	</body>
</html>