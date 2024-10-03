<?php
    include "../headers/dbConn.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        if ($result = $dbConn -> query("SELECT Role FROM User WHERE Username = '$username' LIMIT 1;")) {
            while ($row = $result -> fetch_row()) {
                $role = $row[0];
            }
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            session_write_close();
        }
    }
    $dbConn -> close();
    header("location: ../home/");
    die();