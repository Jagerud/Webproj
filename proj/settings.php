<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jaeger
 * Date: 2017-07-08
 * Time: 15:44
 */
session_save_path('session');
//session_save_path("../../Documents/session");
session_start();
include_once 'includes/functions.php';

include 'includes/navbar.php';
?>

<?php
        if (login_check($mysqli) == true) :

            ?>
            <h2>Settings</h2>

            <div class="well">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Change username</div>
                    <div class="panel-body">
                        <form id="settingName" method="post" action="#" >
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="settingNameInput" placeholder="Enter new username...">
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
                                <button type="button" id="pizza1" class="list-group-item btn-lg btn-block" onclick="getPizza();" > first pizza</button>

                                <?php
                                //TODO  fix sql inject
                                //$query = "SELECT * FROM test.favorite WHERE mid = ($userId) ORDER BY id DESC"; //hÃ¤mtar frÃ¥n databasen i fallande ordning utefter Id
                                //$result = $mysqli->query($query);
                                /*while ($row = $result->fetch_array()){ //letar igenom hela databasen
                                    $id = $row['id']; //databasnamnen
                                    $pizza = $row['pizza'];
                                    echo
                                    "<button type=\"button\" id=\"$id\" class=\"list-group-item btn-lg btn-block\" onclick=\"deletePizza();\">$pizza</button>";
                                } */
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
