<?php
    include "conn.php";
    include "Login&Register.html";
    $userQuery = $dbConn -> query("SELECT Username,Password FROM User");
    $userList = $userQuery -> fetch_all();
    echo "<script> var userlist = ".json_encode($userList)."; </script>";
?>
<script>
loginForm.action = "Login.php";
registerForm.action = "Register.php";
</script>