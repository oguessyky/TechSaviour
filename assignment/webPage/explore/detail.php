<?php
    if (isset($_GET["laptop"])) {
        include "../headers/navBar.php";
        include "detail.html";
    } else {
        header("location: ./");
        die();
    }
