<?php
session_save_path('session');
//session_save_path("../../Documents/session");
if(!isset($_SESSION))   //kollar att den inte redan är startad
{
    session_start();
}
include_once 'includes/functions.php';
include 'includes/navbar.php';

$userId = $_SESSION['user_id'];        //hämtar id från session
$userId = trim($userId);        //tar bort mellanrum

if (isset($_POST['deletePizza'])) {    //kollar om man tryckt på deletepizzaknappen
    $pizzaId = $_POST['pizzaId'];
    $pizzaName = $_POST['pizzaName'];   //Skrivs bara ut
    $pizzaId = trim($pizzaId);
    $pizzaId = htmlspecialchars($pizzaId);
    $query = "DELETE FROM test.favorite WHERE id = (?);"; //tar bort specifikt id från databasen, lånat från lab4 delvis
    if ($stmt = $mysqli->prepare($query)){
        $stmt->bind_param("i", $pizzaId); //gÃ¶r till int
        $stmt->execute();
        $stmt->close();
        $feedback = "<span style='color:green;'>$pizzaName has been removed!</span>";
        echo $feedback;
    }
}

// Databashantering ifrån lab 5
if (isset($_POST['favoriteAdd'])) {    //kollar om man tryckt på submit
    $pizza = $_POST['pizza'];
    $pizza = trim($pizza);

    if ($pizza == "") {
        $feedback = "<span style='color:red;'>Pizza is required</span>";
        echo $feedback;
    } else {

        $exist = 0;
        $userId = htmlspecialchars($userId); // Konverterar allt till vanlig text
        $pizza = htmlspecialchars($pizza);
        $query = "SELECT * FROM test.favorite WHERE mid = (?);"; //hämtar från databasen med rätt id
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $userId); // Sparar som int och string svårare att sql-injecta
            $stmt->execute();
            $result = $stmt->get_result();  //lagrar result

            while ($row = $result->fetch_array()) { //letar igenom hela databasen
                $mid = $row['mid']; //databasnamnen
                $oldPizza = $row['pizza'];
                if ($oldPizza == $pizza) {
                    $exist = 1;
                    $feedback = "<span style='color:red;'>Pizza already exists</span>";
                    echo $feedback;
                    break;
                }
            }
        }

        if ($exist == 0) {    //skickar favoritpizza till databasen, funkar!

            $query = "INSERT INTO `test`.`favorite` (id, pizza, mid) VALUES (NULL, (?),(?));"; //skapar ny rad där id sker automatiskt

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
//om  inloggad
if (login_check($mysqli) == true) :

    ?>
    <h2>Welcome <?php echo htmlentities($_SESSION['email']); ?>!</h2>

    <div class="well">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h2>Add Favourite Pizza!</h2></div>
            <div class="panel-body">
                <form id="form2" method="post" action="#" name="form2Name">
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
                <h3>Click on a pizza to delete it!</h3>
                <!-- Table -->
                <table class="table">
                    <div class="btn-group-vertical" role="group">

                        <?php
                        $query = "SELECT * FROM test.favorite WHERE mid = (?) ORDER BY id DESC;"; //hÃ¤mtar frÃ¥n databasen i fallande ordning utefter id
                        if ($stmt = $mysqli->prepare($query)) {
                            $stmt->bind_param("i", $userId); // Sparar som int och string svårare att sql-injecta
                            $stmt->execute();
                            $result = $stmt->get_result();  //lagrar result
                            while ($row = $result->fetch_array()) { //letar igenom hela databasen
                                $id = $row['id']; //databasnamnen
                                $pizza = $row['pizza'];
                                echo
                                    "
                                    <form action='#' method='post'>
                                        <input type='hidden' name='pizzaId' value='$id'>
                                        <input type='hidden' name='pizzaName' value='$pizza'> 
                                        <button type=\"submit\" name='deletePizza' id=\"$id\" class=\"list-group-item btn-lg btn-block\" >$pizza</button>
                                    </form>
                                    ";
                            }
                        }
                        ?>
                    </div>

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
