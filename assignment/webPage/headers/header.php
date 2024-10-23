<?php
    session_start();
    $isSet = isset($_SESSION['username']);
    $isSet &= isset($_SESSION['role']);

    // require "dbConn.php";
    
    if ($isSet) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
    }
    session_abort();
    include "header.html";
