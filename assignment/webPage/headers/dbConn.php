<?php
$dbConn = mysqli_connect('localhost', 'root', '', 'TechSaViour');

if ($dbConn->connect_error) {
    error_log("Connection failed: " . $dbConn->connect_error);
    exit('<script>alert("Connection failed. Please try again later.");</script>');
}