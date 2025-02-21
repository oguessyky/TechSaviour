<?php
    include "../headers/header.php";
    if ($isSet) {
        header("location: ../home/");
        die();
    }

    $registerScript = "registerForm.username.setCustomValidity('Username cannot be empty.');
        registerForm.name.setCustomValidity('Name cannot be empty.');
        registerForm.email.setCustomValidity('Email cannot be empty.');
        registerForm.password.setCustomValidity('Password cannot be empty.');
        registerForm.password_confirm.setCustomValidity('Please confirm your password.');";

    $loginScript = "loginForm.username.setCustomValidity('Please enter your username.');
        loginForm.password.setCustomValidity('Please enter your password.');";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require "../headers/dbConn.php";
        switch ($_POST['submit']) {
            case 'LOG IN':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $script = $registerScript.
                    "loginForm.username.value = '$username';
                    loginForm.password.value = ".json_encode($password).";";
                if (($result = $dbConn -> query("SELECT Password,Role FROM User WHERE Username = '$username' LIMIT 1;")) -> num_rows > 0) {
                    $row = $result -> fetch_assoc();
                    if ($password == $row['Password']) {
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["role"] = $row['Role'];
                        session_write_close();
                        $dbConn -> close();
                        header("location: ../home/");
                        die();
                    } else {
                        $script .= "loginForm.password.setCustomValidity('Incorrect password.');
                            loginForm.submit.click();";
                    }
                } else {
                    $script .= "loginForm.username.setCustomValidity('User not found.');
                        loginForm.submit.click();";
                }
                break;
            case 'REGISTER':
                $username = $_POST['username'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = json_encode($_POST['password']);
                $passwordConfirm = json_encode($_POST['password_confirm']);
                $script = $loginScript.
                    "document.getElementById('registerLink').click();
                    registerForm.username.value = '$username';
                    registerForm.name.value = '$name';
                    registerForm.email.value = '$email';
                    registerForm.phone.value = '$phone';
                    registerForm.password.value = $password;
                    registerForm.password_confirm.value = $passwordConfirm;";

                if ($dbConn -> query("SELECT Username FROM User WHERE Username = '$username' LIMIT 1;") -> num_rows > 0) {
                    $script .= "registerForm.username.setCustomValidity('Username already exist.');
                        registerForm.submit.click();";
                } else {
                    $dbConn -> query("INSERT INTO User VALUES ('$username','User',$password,'$name','$email','$phone');");
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = "User";
                    session_write_close();
                    $dbConn -> close();
                    header("location: ../home/");
                    die();
                }
                break;
        }
        $dbConn -> close();

    } else {
        $script = $registerScript.$loginScript;
    }

    include "Login&Register.html";
    echo "<script>$script</script>";