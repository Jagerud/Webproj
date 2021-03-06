<?php
//Tagit från http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
//ändrat så det fungerar och ändrat smådetaljer, har jquery validation på annan inmatning
session_save_path('../session');
//session_save_path("../../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include_once 'db.php';

$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {

    // skydd för injects http://php.net/manual/en/filter.filters.sanitize.php
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {

        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
    $query = "SELECT id FROM test.members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            $stmt->close();
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
        $stmt->close();
    }
    // testa användarnamn
    $query = "SELECT id FROM test.members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // användare finns
            $error_msg .= '<p class="error">A user with this username already exists</p>';
            $stmt->close();
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error line 55</p>';
        $stmt->close();
    }

    if (empty($error_msg)) {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

        // lägger in användaren
        if ($insert_stmt = $mysqli->prepare("INSERT INTO test.members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../proj/error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}