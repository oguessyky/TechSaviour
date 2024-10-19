<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require "../headers/dbConn.php";
        $oldUsername = $_POST['oldUsername'];
        $newUsername = $_POST['newUsername'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $dbConn -> query("UPDATE User SET Username = '$newUsername', Role = '$role', Name = '$name', Email = '$email', Phone = '$phone' WHERE Username = '$oldUsername';");
        $dbConn -> close();
    }
    header("location: ./?data=user");
    die();