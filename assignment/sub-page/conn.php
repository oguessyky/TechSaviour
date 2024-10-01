<?php
$dbConn = mysqli_connect('localhost','root','','TechSaViour');
if (mysqli_connect_errno()) {
    die('<script>alert("Connection failed: Please check your SQL connection!");</script>');
}