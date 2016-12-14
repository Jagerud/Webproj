<?php

	include("includes/db.php"); //inlogg till databas
	
	if (isset($_POST['submit'])){	//kollar om man tryckt på submit
		
		$name = $_POST['name'];		//hämtar name
		$name = trim($name);		//tar bort mellanrum

		if ($name == "" ){
			$feedback = "<span style='color:red'>Name is required</span>";
			echo $feedback;
		}
		else{
				$exist = 0;

			$databaseNames = "SELECT * FROM filni797.actor ORDER BY aid DESC"; //hämtar från databasen i fallande ordning utefter Id
			$databaseResult = $mysqli->query($databaseNames);
			while ($row = $databaseResult->fetch_array()){ //letar igenom hela databasen
				$aid = $row['aid']; //databasnamnen
				$oldName = $row['name'];
				if($oldName == $name){
					$exist = 1;
					$feedback = "<span style='color:red'>Name already exists</span>";
					echo $feedback;
					break;
				}
			}

			if($exist == 0){
			$name = htmlspecialchars($name); // Konverterar allt till vanlig text
			$query = "INSERT INTO `filni797`.`actor` (`aid`, `name`) VALUES (NULL, ?);"; //skapar ny rad där id sker automatiskt
			
			if ($stmt = $mysqli->prepare($query)){
				$stmt->bind_param("s", $name); // Sparar som string och går då inte sql-injecta
				$stmt->execute();
				$stmt->close();
				
			}
		}
	}
}
	if (isset($_POST['delete'])){ //Kod för att implementera delete
		$deleteId = $_POST['deleteId'];
		echo $deleteId;
		$query = "DELETE FROM part WHERE part.pid = (?)"; //tar bort specifikt id ifrån databasen
			
		if ($stmt = $mysqli->prepare($query)){
			$stmt->bind_param("i", $deleteId); //gör till int 
			$stmt->execute();
			$stmt->close();
			
		}
	} 
	if (isset($_GET['submit2'])){		//Sparar rätt id å namn
		$urlid = $_GET['urlid'];
		//$nameSaved = $_GET['name'];
		
		//$test = $_GET['submit2'];
	} 
	if (isset($_POST['submit3'])){	//kollar om man tryckt på submit3
		$id2 = $_POST['id2'];
		$newName = $_POST['newName'];		//hämtar name
		$newName = trim($newName);		//tar bort mellanrum
		if ($newName == "" ){
			$feedback = "<span style='color:red'>Name is required</span>";
			echo $feedback;
		}
		else{
		$exist = 0;

		$databaseNames = "SELECT * FROM filni797.actor ORDER BY aid DESC"; //hämtar från databasen i fallande ordning utefter Id
		$databaseResult = $mysqli->query($databaseNames);
		while ($row = $databaseResult->fetch_array()){ //letar igenom hela databasen
			$aid = $row['aid']; //databasnamnen
			$name = $row['name'];
			if($name == $newName){
				$exist = 1;
				$feedback = "<span style='color:red'>Name already exists</span>";
				echo $feedback;
				break;
			}
		}

		if($exist == 0){

			$newName = htmlspecialchars($newName); // Konverterar allt till vanlig text
			$query = "UPDATE filni797.actor SET name= (?) WHERE actor.aid = (?)";
		
			if ($stmt = $mysqli->prepare($query)){
			$stmt->bind_param("si", $newName, $id2); // Sparar som string och går då inte sql-injecta
			$stmt->execute();
			$stmt->close();
			}
		}
	}
	
	} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PoopStuff</title>
		<meta name="Gonzmoviez!" content="Huge amazing database of movies!">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/stylesheet.css">
		<!-- <style>body{background-image: url("img/bg.jpg");}</style> -->
		
	</head>

	<body>
		<div class="header">
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="index.php">Home</a></li>
			  <li role="presentation" class="active"><a href="actor.php">Actors</a></li>
			  <li role="presentation"><a href="film.php">Movies</a></li>
			  <li role="presentation"><a href="link.php">Connect</a></li>
			</ul>
		</div>
			
		<div class="container">
			
			<div class="title"><h1>GONZMOVIEZ</h1></div>
			<h2>Add new actor</h2>
			<form id="form1" method="post" >
				<div class="row">
				  
				  <div class="col-lg-12">
				    <div class="input-group">

				      <input type="text" class="form-control" name="name" placeholder="Enter actor...">
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="submit" name="submit">Submit!</button>
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			</form>

			<h2>Display actor info</h2>
			<form id="form" method="GET" >
				
				  <div class="row">
				  <div class="col-lg-12">
				    <div class="input-group">
				    	<div> 
						      <select class="form-control" id="urlid" name="urlid" title="Select a movie"> 
						        <?php  
						                $query = "SELECT * FROM filni797.actor ORDER BY aid DESC"; //hämtar från databasen i fallande ordning utefter Id
										$result = $mysqli->query($query);
										while ($row = $result->fetch_array()){ //letar igenom hela databasen
											$aid = $row['aid']; //databasnamnen
											$name = $row['name'];
						                    echo "<option value='$aid $name'> $name </option>";     
						                } ?> 
						      </select>
					    	</div>
				     
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="submit" name="submit2">Enter!</button>
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			
			</form>
			
	    		<?php
	    		if (isset($_GET['submit2'])){
		    		echo "  
		    		<h3>Change name on actor with ID and name"; ?> <?php echo $urlid; ?> <?php echo " </h3>
			    		<form action='' method='POST'  name='something' id='form2'>	
			    					<div>
			    						<div class='row'>
							  
										  <div class='col-lg-12'>
										    <div class='input-group'>
										      <input type='text' class='form-control' name='newName' placeholder='Enter new name...''>
										      <span class='input-group-btn'>
										        <button class='btn btn-default' type='submit' name='submit3' value='Submit'>Submit!</button>
										        <input type='hidden' name='id2' value="; ?> <?php echo $urlid; ?> <?php echo " > <!-- Fångar rätt id -->
										      </span>
										    </div><!-- /input-group -->
										  </div><!-- /.col-lg-6 --a>
										</div><!-- /.row -->
			    					</div>
			  				
						</form>
					";
				
			 echo "<h2>Actor is in the movies:</h2><br>
			 <table>
				<thead>
				<tr><th>Title</th><th>Year</th><th>Id</th></tr> 
				</thead>
				<tbody>";
					//<?php //			in är där actor och filmid sparas, urlid är aktuella id för actor
					
					
					//http://stackoverflow.com/questions/6032691/sql-select-from-three-tables
					$query = "SELECT part.* , actor.* , film.* FROM part 
					INNER JOIN actor ON part.actorid = '' 
					INNER JOIN film ON part.filmid = film.fid WHERE part.filmid"; 
					if ($stmt = $mysqli->prepare($query)){
						$stmt->bind_param("i",$urlid); // Sparar som string och går då inte sql-injecta
						$stmt->execute();
						$stmt->close();
						
					
					$result = $mysqli->query($query);

					//echo $result;
					
					while ($row = $result->fetch_array()){ //letar igenom hela arrayen
						
						$newId = $row['pid']; // testa olika id
						$title = $row['title']; 
						$year = $row['year'];
						
						echo 
							"<tr>
								<td>$title</td>
								<td>$year</td>
								<td>$newId</td>
								<td>
									<form action='#' method='post'>
										<input type='hidden' name='deleteId' value='$newId'> 
										<input type='submit' name='delete' value='Delete!'>
									</form>
								</td>
							</tr>";			
					}
					}
				//}
				echo "	
				<tbody>
			</table>";}
?> 
		<!--http://www.w3schools.com/php/php_mysql_update.asp-->
		
		</div>
		
		<?php 	include("includes/scripts.php"); ?>
	</body>
</html>
