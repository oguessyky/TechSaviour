<?php
    if (isset($_GET["laptop"])) {
        include "../headers/navBar.php";
        include "detail.html";
        require "../headers/dbConn.php";
        
    } else {
        header("location: ./");
        die();
    }