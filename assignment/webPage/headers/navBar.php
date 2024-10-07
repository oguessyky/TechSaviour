<?php
    include "header.php";
    if ($isSet && $role == 'Admin') {
        header("location: ../admin/");
        die();
    }
    include "navBar.html";
    if ($isSet) {
        echo "<script>document.getElementById('login').innerHTML = '$username'</script>";
        echo "<style>.profile:hover .profileOptions {display: block;}</style>";
    }