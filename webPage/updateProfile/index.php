<?php
    include "../headers/header.php";
    if ($isSet) {
        require "../headers/dbConn.php";
        if ($result = $dbConn -> query("SELECT Name,Email,Phone,Password FROM User WHERE Username = '$username';")) {
            $row = $result -> fetch_assoc();

            $script = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $newUsername = $_POST['newUsername'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $updateValues = "UPDATE User SET Username = '$newUsername', Name = '$name', Email = '$email', Phone = '$phone'";
                $allowUpdate = true;

                if ($username != $newUsername && $dbConn -> query("SELECT Username FROM User WHERE Username = '$newUsername' LIMIT 1;") -> num_rows > 0) {
                    $allowUpdate = false;
                    $script .= "updateForm.newUsername.setCustomValidity('Username already exist.');
                        updateForm.submit.click();";
                } else if ($password = $_POST['password']) {
                    $allowUpdate = $password == $row['Password'];

                    $newPassword = json_encode($_POST['newPassword']);

                    $script .= "updateForm.password.value = ".json_encode($password).";
                        updateForm.newPassword.value = $newPassword;
                        updateForm.passwordConfirm.value = ".json_encode($_POST['passwordConfirm']).";";
    
                    $updateValues .= ", Password = $newPassword";
                    if (!$allowUpdate) {
                        $script .= "updateForm.password.setCustomValidity('Incorrect password.');
                        updateForm.submit.click();";
                    }
                }
                if ($allowUpdate) {
                    $dbConn -> query("$updateValues WHERE Username = '$username';");
                    session_start();
                    $_SESSION["username"] = $newUsername;
                    session_write_close();
                    $dbConn -> close();
                    header("location: ../home/");
                    die();
                }
            } else {
                $newUsername = $username;
                $name = $row['Name'];
                $email = $row['Email'];
                $phone = $row['Phone'];
            }

            include "updateProfile.html";
            echo "<script>
                updateForm.newUsername.value = '$newUsername';
                updateForm.name.value = '$name';
                updateForm.email.value = '$email';
                updateForm.phone.value = '$phone';
                const currentUsername = '$username';
                $script
            </script>";
        }
        $dbConn -> close();
    } else {
        header("location: ../home/");
        die();
    }