<?php
    include "header.php";
    include "navBar.html";
    if ($isSet) {
        echo "<script>document.getElementById('login').innerHTML = '$username'</script>";
    }
