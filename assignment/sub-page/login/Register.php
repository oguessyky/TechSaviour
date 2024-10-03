<?php
    include "../headers/dbConn.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $dbConn -> query("INSERT INTO USER VALUES ('$username','User','$password','$name','$email','$phone');");
        session_start();
        $_SESSION["username"] = $username;
        session_write_close();
    }
    header("location: ../home/");
    die();