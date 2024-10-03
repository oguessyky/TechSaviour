<?php
    session_start();
    $isSet = isset($_SESSION['username']);
    $isSet &= isset($_SESSION['role']);
    if ($isSet) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
    }
    session_abort();
    if ($isSet && $role == 'Admin') {
        header("location: ../admin/adminPage1.html");
        die();
    }
    include "header.html";