<?php
$dbConn = mysqli_connect('localhost','root','','TechSaViour');
if ($dbConn -> connect_error) {
    die('<script>alert("Connection failed: '.$dbConn -> connect_error.'");</script>');
}