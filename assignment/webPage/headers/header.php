<?php
    session_start();
    $isSet = isset($_SESSION['username']);

    if ($isSet) {
        require "dbConn.php";
        $username = $_SESSION['username'];
        if (($result = $dbConn -> query("SELECT Role FROM User WHERE Username = '$username'")) -> num_rows > 0) {
            $role = $result -> fetch_row() [0];
            session_abort();
        } else {
            $isSet = false;
            session_destroy();
            session_write_close();
        }
        $dbConn -> close();
    }
    include "header.html";
