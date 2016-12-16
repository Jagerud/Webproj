<?php
session_save_path("../../Documents/session");
session_start();
include_once 'includes/functions.php';

include 'includes/navbar.php';
//INTE FIXAT BARA TEST
 
//sec_session_start();

// Databashantering ifrån lab 5
if (isset($_POST['favoriteAdd'])) {    //kollar om man tryckt på submit
    $pizza = $_POST['pizza'];
    $userId = $_SESSION['user_id'];        //hämtar name
    $userId = trim($userId);        //tar bort mellanrum
    $pizza = trim($pizza);
    if ($pizza == "") {
        $feedback = "<span style='color:red'>Pizza is required</span>";
        echo $feedback;
    } else {

        $exist = 0;
        $userId = htmlspecialchars($userId); // Konverterar allt till vanlig text
        $pizza = htmlspecialchars($pizza);
        //någonting har blivit fel med sql inject skyddet på denna select, (tror det behövs?)
        //Hinner inte fixa detta nu men är en enkel fix om man har lite mer tid. Skulle vara en where med "mid".
        $databaseNames = "SELECT * FROM filni797.favorite;"; //hämtar från databasen i fallande ordning utefter mid

            //deletad sql injectskydd och bättre select som hämtade bara användarens pizzor


            $databaseResult = $mysqli->query($databaseNames);
            while ($row = $databaseResult->fetch_array()) { //letar igenom hela databasen

                $mid = $row['mid']; //databasnamnen
                $oldPizza = $row['pizza'];
                if ($oldPizza == $pizza) {
                    $exist = 1;
                    $feedback = "<span style='color:red'>Name already exists</span>";
                    echo $feedback;
                    break;
                }
            }

            if ($exist == 0) {    //skickar favoritpizza till databasen, funkar!

                $query = "INSERT INTO `filni797`.`favorite` (id, pizza, mid) VALUES (NULL, (?),(?));"; //skapar ny rad där id sker automatiskt
                //$query = "INSERT INTO `filni797`.`favorite` (`id`, `pizza`, `mid`) VALUES (NULL, 'pizzatest', '7');
                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param("ss", $pizza, $userId); // Sparar som string och går då inte sql-injecta
                    $stmt->execute();
                    $stmt->close();

                }
            }
        }
    }


?>
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
                    <div class="panel-heading">Add Favourite Pizza!</div>
                    <div class="panel-body">
                        <form id="form2" method="post" action="#" >
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="pizza" placeholder="Enter Favorite Pizza...">
                                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="favoriteAdd">Submit!</button>
                      </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div><!-- /.row -->
                        </form>

                    <!-- Table -->
                    <table class="table">
                        ...
                    </table>
                </div>
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
