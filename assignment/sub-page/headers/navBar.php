<?php
    session_start();
    include "header.html";
    include "navBar.html";
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<script>document.getElementById('login').innerHTML = '$username'</script>";
    }
