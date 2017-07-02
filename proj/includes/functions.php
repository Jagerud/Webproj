<?php
session_save_path('../session');
//session_save_path('../../../Documents/session');

if(!isset($_SESSION))
{
    session_start();
}
include("db.php");

function login($email, $password, $mysqli)
{    //lösenorden är olika, något fel med krypteringen? lösenorden ändras inte,
    //olika användare har ett inmatat och ett databaslösenord
    //skapar variablerna för att sedan mata in data ifrån db nedanför.
    $user_id = null;
    $username = null;
    $db_password = null;
    $salt = null;
    //echo "1";
    //echo $user_id;
    //echo "pass " .  $password;

    if ($stmt = $mysqli->prepare("SELECT id, username, password FROM members 
		WHERE email = ? LIMIT 1")
    ) { //LIMIT 1 gör att hämtar bara 1
        $stmt->bind_param('s', $email); //binder email som stringparameter
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($user_id, $username, $db_password);
        $stmt->fetch();

        if ($stmt->num_rows == 1) { // om användaren finns
            if(checkbrute($user_id, $mysqli) == true) {   //Bortkommenterat under testning

                header('Location: ../error.php?err=Account locked for 1 hour, too many tries');
                //användare låst skicka mail INTE IMPLEMENTERAT!
                return false;
            }
            echo "db pass : " . $db_password . " <br>  å inskcikat:                                      " . $password;
            if ($db_password == $password) {
                //echo " 4 ";
                $user_browser = $_SERVER['HTTP_USER_AGENT']; //http://stackoverflow.com/questions/13252603/how-works-http-user-agent
                $user_id = preg_replace("/[^0-9]+/", "", $user_id); //tar bort specialtecken OKLART MED PLUSET
                $_SESSION['user_id'] = $user_id;
//Kan vara fel med plus
                $username = preg_replace("/[^a-zA-Z0-9_-]+/", "", $_SESSION['username']);// = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser); //kryptering

                return true;
            } else { //fel lösen

                $now = time(); //tiden för försöket
                $mysqli->query("INSERT INTO login_attempts(user_id, time) VALUES ('$user_id', '$now')");
                return false;
            }
            //}
        } else { //användaren finns inte
            return false;
        }

    }
}

function checkbrute($user_id, $mysqli)
{
    $now = time();

    $valid_attempts = $now - (60 * 60); //närmsta timmen som räknas

    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts 
		WHERE user_id = ? AND time > '$valid_attempts'")
    ) {

        $stmt->bind_param('i', $user_id);

        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 5) { //om mer än 5 försök blir funktionen sann
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli)
{

    if (isset($_SESSION['user_id'] /*$_SESSION['username']*/, $_SESSION['login_string'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {

                $password = null; //initierar password för att inte kasta error, får värde
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) { //inloggad
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

    } else {
        return false;
    }
}

function esc_url($url)
{

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url); //tar bort url
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string)$url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
