<?php
    include "../headers/header.php";
    if ($isSet && $_SERVER['REQUEST_METHOD'] == 'POST') {
        require "../headers/dbConn.php";
        $newUsername = $_POST['newUsername'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $updateValues = "UPDATE User SET Username = '$newUsername', Name = '$name', Email = '$email', Phone = '$phone'";
        if ($password = $_POST['newPassword']) {
            $updateValues .= ", Password = ".json_encode($password);
        }

        if ($dbConn -> query("$updateValues WHERE Username = '$username';")) {
            session_start();
            $_SESSION["username"] = $newUsername;
            session_write_close();
        };
        $dbConn -> close();
    }
    header("location: ../home/");
    die();