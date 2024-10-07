<?php
    include "header.php";

    // Ensure $isSet and $role are initialized
    if (isset($isSet) && $isSet && isset($role) && $role == 'Admin') {
        header("Location: ../admin/");
        exit();
    }

    include "navBar.html";

    if (isset($isSet) && $isSet) {
        // Sanitize $username to prevent XSS
        $safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        echo "<script>document.getElementById('login').innerHTML = '$safeUsername'</script>";
        echo "<style>.profile:hover .profileOptions {display: block;}</style>";
    }
