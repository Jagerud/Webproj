<?php
//inte klar
//Mycket med inloggning är inspirerat eller lånat från http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
//TODO titta igenom, typ klar
session_save_path('../session');
//session_save_path('../../../Documents/session');

if(!isset($_SESSION))
{
    session_start();
}
include("db.php");

function login($email, $password, $mysqli)
{
    //skapar variablerna för att sedan mata in data ifrån db nedanför.
    $user_id = null;
    $username = null;
    $db_password = null;
    $salt = null;

    if ($stmt = $mysqli->prepare("SELECT id, username, password FROM test.members 
		WHERE email = ? LIMIT 1")) { //LIMIT 1 gör att hämtar bara 1

        $stmt->bind_param('s', $email); //binder email som stringparameter
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($user_id, $username, $db_password);
        $stmt->fetch();

        if ($stmt->num_rows == 1) { // om användaren finns
            if(checkbrute($user_id, $mysqli) == true) {   //Bortkommenterat under testning

                header("Location: ../error.php?err=Account locked for 1 hour, too many tries");
                //header("Location: ../error.php");

                //användare låst skicka mail INTE IMPLEMENTERAT!
                return false;
            }
            if ($db_password == $password) {
                $user_browser = $_SERVER['HTTP_USER_AGENT']; //http://stackoverflow.com/questions/13252603/how-works-http-user-agent
                $user_id = preg_replace("/[^0-9]+/", "", $user_id); //tar bort specialtecken
                $_SESSION['user_id'] = $user_id;
                $username = preg_replace("/[^a-zA-Z0-9_-]+/", "", $_SESSION['username']);// = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser); //kryptering

                return true;
            } else { //fel lösen

                $now = time(); //tiden för försöket
                if ($insert_stmt = $mysqli->prepare("INSERT INTO test.bruteforce(mid, time) VALUES (?, ?)")) {
                    $insert_stmt->bind_param('ss', $user_id, $now);
                    $insert_stmt->execute();
                }
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

    if ($stmt = $mysqli->prepare("SELECT time FROM test.bruteforce 
		WHERE mid = ? AND time > ?")) {
        $stmt->bind_param('ii', $user_id, $valid_attempts);
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

        if ($stmt = $mysqli->prepare("SELECT password FROM test.members WHERE id = ? LIMIT 1")) {
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
//lånat från http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
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
        return '';
    } else {
        return $url;
    }
}
function deletePizza(){

}
