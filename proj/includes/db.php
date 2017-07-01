<?php
//http://www.ida.liu.se/~725G54/material/kod/mysql/includes/db.inc.phps
/*$host = "db-und.ida.liu.se";
$user = "filni797";
$password = "filni7975cea";
$database = "filni797";*/
$host = "localhost";
$user = "root";
$password = "";
$database = "test";

$can_register = "any";
$default_role = "member";

$secure = FALSE;

$mysqli = new mysqli("$host", "$user", "$password", "$database");
?>