<?php
    include "conn.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $result = $dbConn -> query("SELECT * FROM USER WHERE Username = '$username';");
        if ($result -> num_rows > 0) {
            die(
                "<script>
                window.history.go(-1);
                alert('Username already exists!');
                </script>"
            );
        } else {
            mysqli_query($dbConn, "INSERT INTO USER VALUES ('$username','User','$password','$name','$email','$phone');");
            header("location: ../index.html");
            die();
        }
    } else {
        header("location: ../index.html");
        die();
    }