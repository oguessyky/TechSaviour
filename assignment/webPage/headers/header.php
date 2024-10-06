<?php
    session_start();
    $isSet = isset($_SESSION['username']);
    $isSet &= isset($_SESSION['role']);
    if ($isSet) {
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
    }
    session_abort();
    include "header.html";
