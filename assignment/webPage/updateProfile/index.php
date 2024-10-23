<?php
    include "../headers/header.php";
    if (!$isSet) {
        header("location: ../home/");
        die();
    }
    require "../headers/dbConn.php";
    if ($result = $dbConn -> query("SELECT Name,Email,Phone FROM User WHERE Username = '$username';")) {
        $row = $result -> fetch_assoc();
        include "updateProfile.html";
        $userQuery = $dbConn -> query("SELECT Username,Password FROM User;");
        $userList = $userQuery -> fetch_all();
        echo "<script> 
            var userList = ".json_encode($userList).";
            updateForm.newUsername.value = '$username';
            updateForm.name.value = '".$row['Name']."';
            updateForm.email.value = '".$row['Email']."';
            updateForm.phone.value = '".$row['Phone']."';
        </script>";
    }
    $dbConn -> close();
?>
<script>const currentUsername = '<?php echo $username ?>';</script>