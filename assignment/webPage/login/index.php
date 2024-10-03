<?php
    include "../headers/header.php";
    if ($isSet) {
        header("location: ../home/");
        die();
    }
    include "../headers/dbConn.php";
    include "Login&Register.html";
    $userQuery = $dbConn -> query("SELECT Username,Password FROM User");
    $userList = $userQuery -> fetch_all();
    $dbConn -> close();
    echo "<script> var userList = ".json_encode($userList)."; </script>";

?>
<script>
loginForm.action = "Login.php";
registerForm.action = "Register.php";
</script>