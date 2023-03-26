<?php
    $dsn = mysqli_connect("localhost", "root", "", "Zippys");

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = 'Database error';
        $error_message .= $e->getMessage();
        echo $error_message;
        exit();
    }
?>