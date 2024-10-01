<?php
    include "conn.php";
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    mysqli_query($dbConn, "INSERT INTO USER VALUES ('$username','User','$password','$name','$email','$phone');");
?>