<?php
//TODO jobba vidare, kunna ge förslag på veckans pizza och se andras förslag, kanske kunna rösta
/**
 * Created by IntelliJ IDEA.
 * User: Jaeger
 * Date: 2017-07-08
 * Time: 15:44
 */
session_save_path('session');
//session_save_path("../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include_once 'includes/functions.php';
include 'includes/navbar.php';

$userId = $_SESSION['user_id'];        //hämtar id
$userId = trim($userId);        //tar bort mellanrum
if (isset($_POST['settingNameSubmit'])) {    //kollar om man tryckt på submit
    $newMail = $_POST['settingNameInput'];

    $newMail = trim($newMail);
    if ($newMail == "") {
        $feedback = "<span style='color:red'>Mail is required</span>";
        echo $feedback;
    } else {

        $exist = 0;
        $userId = htmlspecialchars($userId); // Konverterar allt till vanlig text
        $newMail = htmlspecialchars($newMail);
        //WHERE id = (?);"; //hämtar användarens mail från databasen
        $query = "SELECT email FROM test.members;"; //hämtar alla mailaddresser
        if ($stmt = $mysqli->prepare($query)) {
            //$stmt->bind_param("i", $userId); // Sparar som string och går då inte sql-injecta
            $stmt->execute();
            $result = $stmt->get_result();  //lagrar result
            while ($row = $result->fetch_array()) { //letar igenom hela databasen
                $oldMail = $row['email'];
                if ($oldMail == $newMail) {
                    $exist = 1;
                    $feedback = "<span style='color:red'>Email already exists</span>";
                    echo $feedback;
                    break;
                }
            }
            $stmt->close();
        }
        if ($exist == 0) {    //lagrar ny mail

            $query = "UPDATE test.members SET email = (?) WHERE id = (?);"; //uppdaterar mailen
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("si", $newMail, $userId); // Sparar som int och string svvårare att sql-injecta
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
    <h2>Settings</h2>

    <div class="well">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Change mail</div>
            <div class="panel-body">
                <form id="settingName" method="post" action="#" name="settingNameForm" >
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-5">
                            <div class="input-group">
                                <input type="text" class="form-control" name="settingNameInput" placeholder="Enter new mail...">
                                <span class="input-group-btn">
                                             <button class="btn btn-default" type="submit" name="settingNameSubmit">Submit!</button>
                                        </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-sm-3 -->
                    </div><!-- /.row -->
                </form>

                <!-- Table -->
                <table class="table">
                    <div class="btn-group-vertical" role="group">
                        <?php
                        $query = "SELECT email FROM test.members WHERE id = (?);"; //hÃ¤mtar användarens mail
                        if ($stmt = $mysqli->prepare($query)) {
                            $stmt->bind_param("i", $userId); // Sparar som int och string svårare att sql-injecta
                            $stmt->execute();
                            $result = $stmt->get_result();  //lagrar result
                            if($row = $result->fetch_array()){  //om det finns results hämta array
                                $mail = $row['email'];  //hämta från email kolumnen, finns bara en så behöver inte loopa
                                echo "<button type=\"button\" class=\"list-group-item btn-lg btn-block\">$mail</button>";
                            }
                            $stmt->close();
                        }

                        //$result = $mysqli->query($query);
                        //while ($row = $stmt->fetch_array()){ //letar igenom hela databasen

                        //    $mail = $row['email'];
                           // echo
                           // "<button type=\"button\" class=\"list-group-item btn-lg btn-block\" onclick=\"deletePizza();\">$row</button>";
                        //}
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
