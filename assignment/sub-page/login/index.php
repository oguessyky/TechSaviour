<?php
    include "../headers/dbConn.php";
    include "../headers/header.html";
    include "Login&Register.html";
    $userQuery = $dbConn -> query("SELECT Username,Password FROM User");
    $userList = $userQuery -> fetch_all();
    echo "<script> var userList = ".json_encode($userList)."; </script>";
?>
<script>
loginForm.action = "Login.php";
registerForm.action = "Register.php";
</script>