<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require "../headers/dbConn.php";
        $username = $_POST['username'];
        $result = $dbConn -> query("SELECT Role FROM User WHERE Username = '$username' LIMIT 1;");
        $dbConn -> close();
        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_row()) {
                $role = $row[0];
            }
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            session_write_close();
            header("location: ../home/");
            die();
        }
    }
    header("location: ../login/");
    die();