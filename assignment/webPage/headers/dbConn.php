<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
        header("location: ../home/");
    } else {
        $dbConn = mysqli_connect('localhost','root','','TechSaViour');
        if ($dbConn -> connect_error) {
            die('<script>alert("Connection failed: '.$dbConn -> connect_error.'");</script>');
        }
    }
