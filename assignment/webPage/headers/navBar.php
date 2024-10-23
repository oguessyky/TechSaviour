<?php
    include "header.php";
    if ($isSet && $role == 'Admin') {
        header("location: ../admin/");
        die();
    }
    include "navBar.html";
    if ($isSet) {
        echo "<script>
            document.getElementById('login').innerHTML = '$username';
            document.getElementById('login').onclick = '';
        </script>
        <style>
            .profile:hover .profileOptions {
                display: flex;
            }
        </style>";
    }