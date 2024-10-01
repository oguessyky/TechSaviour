<?php
    include "conn.php";
?>
<!DOCTYPE html>
<html lang="en" class="loginPage">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="../image/x-icon" href="../image/thumbnail.png">
    <script src="../js/inputValidation.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="loginPage">
    <div class="login">
        <form>
            <h2>Login</h2>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="text" id = "login_username" name = "username" placeholder="Username" required autofocus maxlength="20">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="password" placeholder="Password" required maxlength="255">
            </div>
            <div class="input">
                <input type="submit" value="Sign in">
            </div>
            <div class="group">
                <a href="#" id="registerLink">Register</a>
            </div>
        </form>
    </div>

    <div class="register" style="display: none;">
        <form name="Register" method="post" action="Register.php" novalidate>
            <h2>Register</h2>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="text" name="username" id="register_username" placeholder="Username" required autofocus pattern="^[\w_]*$" maxlength="20" data-error="Username can only contain letters, numbers, and underscores.">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="text" name="name" placeholder="Name" required pattern="[\w\s]*$" data-error="Name must can only contain letters, numbers, and space" maxlength="255">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="email" name="email" placeholder="Email" required pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" data-error="Please enter a valid email address." maxlength="255">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="tel" name="phone" placeholder="Phone number" required pattern="^\+((?:9[679]|8[035789]|6[789]|5[90]|42|3[578]|2[1-689])|9[0-58]|8[1246]|6[0-6]|5[1-8]|4[013-9]|3[0-469]|2[70]|7|1)(?:\W*\d){0,13}\d$" data-error="Please enter a valid phone number." maxlength="20">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="password" name="password" placeholder="Password" required data-error="Password cannot be empty." maxlength="255">
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <span class="error-message"></span>
                <input type="password" name="password_confirm" placeholder="Confirm Password" required data-error="Please confirm your password." maxlength="255">
            </div>
            <div class="input">
                <input type="submit" value="Register">
            </div>
            <div class="group">
                <a href="#" id="loginLink">Login</a>
            </div>
        </form>
    </div>

    <?php
        $userQuery = $dbConn -> query("SELECT Username FROM User");
        $userList = $userQuery -> fetch_all();
        echo "<script> var userlist = ".json_encode($userList)."; </script>";
    ?>

    <script>
        function userExists(username) {
            for (user of userlist) {
                if (user.includes(username)) {
                    return true;
                }
            }
            return false;
        }

        registerForm = document.forms['Register'];

        function usernameUnique() {
            input = registerForm['username'];
            errorMsg = input.nextElementSibling;
            if (userExists(input.value)) {
                errorMsg.textContent = "Username already exist.";
                errorMsg.style.display = 'flex';
                input.parentNode.classList.add('invalid');
                return false;
            } else if (input.validity.valid) {
                errorMsg.style.display = 'none';
                input.parentNode.classList.remove('invalid');
                return true;
            }
            return false;
        }

        validateForm(registerForm);

        registerForm['username'].addEventListener('change', usernameUnique);

        registerForm.addEventListener('submit',function(event) {
            if (!usernameUnique) {
                this['username'].focus;
                event.preventDefault();
            }
        });

        document.getElementById('registerLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.body.classList.remove('loginPage');
            document.body.classList.add('registerPage');
            document.querySelector('.login').style.display = 'none';
            document.querySelector('.register').style.display = 'flex';
            document.title = 'Register';
            document.getElementById('register_username').focus();
        });

        document.getElementById('loginLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.body.classList.remove('registerPage');
            document.body.classList.add('loginPage');
            document.querySelector('.register').style.display = 'none';
            document.querySelector('.login').style.display = 'flex';
            document.title = 'Login';
            document.getElementById('login_username').focus();
        });
    </script>
</body>
</html>
