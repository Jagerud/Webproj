<?php
//klar förutom källa
include_once 'functions.php';

session_save_path('../session');
//    session_save_path("../../../Documents/session");
session_start();
$_SESSION = array(); //nollställ sessionsarray
$params = session_get_cookie_params(); //ladda parmetrar

setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]); //ta bort cookie

session_destroy(); //avsluta session
header('Location: ../index.php');