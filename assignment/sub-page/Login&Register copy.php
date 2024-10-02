<!DOCTYPE html>
<html lang="en" class="loginPage">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="../image/x-icon" href="../image/thumbnail.png">
    <script src="../js/inputValidation2.js"></script>
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
        <form name="Register" method="post" action="Register.php">
            <h2>Register</h2>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="text" name="username" id="register_username"
                placeholder="Username" required autofocus
                pattern="^[\w_]*$" maxlength="20"
                oninput="return validateInput(this,
                'Username must only contain letters(A-Z), numbers(0-9), and underscores(_).',
                [isEmpty,'Username cannot be empty.'],
                [userExists, 'Username already exist.']);">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="text" name="name" placeholder="Name"
                required pattern="[\w\s]*$" maxlength="255"
                oninput="return validateInput(this,
                'Name must can only contain letters(A-Z,a-z), numbers(0-9), and spaces( ).',
                [isEmpty,'Name cannot be empty.']);">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="email" name="email" placeholder="Email"
                required pattern="^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$" maxlength="255"
                oninput="return validateInput(this,
                'Please enter a valid email address.',
                [isEmpty,'Email cannot be empty.']);">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="tel" name="phone" placeholder="Phone number"
                required maxlength="20"
                pattern="^\+((?:9[679]|8[035789]|6[789]|5[90]|42|3[578]|2[1-689])|9[0-58]|8[1246]|6[0-6]|5[1-8]|4[013-9]|3[0-469]|2[70]|7|1)(?:\W*\d){0,13}\d$"
                oninput="return validateInput(this,
                'Please enter a valid phone number.',
                [isEmpty,'Phone number cannot be empty.']);">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="password" name="password" placeholder="Password"
                required maxlength="255"
                oninput="return validateInput(this,
                'Password cannot be empty.');">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <span class="inputSpan"></span>
                <input type="password" name="password_confirm" placeholder="Confirm Password"
                required maxlength="255"
                oninput="return validateInput(this,
                'Please confirm your password.',
                [password => password != document.forms.Register.password.value, 'Passwords do not match.']);">
                <span class="error-message"></span>
            </div>
            <div class="input">
                <input type="submit" value="Register">
            </div>
            <div class="group">
                <a href="#" id="loginLink">Login</a>
            </div>
        </form>
        <script>
            registerForm = document.forms.Register;
            registerForm.username.setCustomValidity('Username cannot be empty.');
            registerForm.name.setCustomValidity('Name cannot be empty.');
            registerForm.email.setCustomValidity('Email cannot be empty.');
            registerForm.password.setCustomValidity('Password cannot be empty.');
            registerForm.password_confirm.setCustomValidity('Please confirm your password.');
        </script>
    </div>

    <?php
        include "conn.php";
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
