<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../headers/header.php";
        require "../headers/dbConn.php";
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                break;
            case 'user':
                if ($result = $dbConn -> query("SELECT Username,Name,Email,Phone,Role FROM User WHERE Username = '$id' LIMIT 1;")) {
                    include "userEdit.html";
                    $row = $result -> fetch_row();
                    $userQuery = $dbConn -> query("SELECT Username FROM User WHERE Username != '$id'");
                    $userList = $userQuery -> fetch_all();
                    echo "<script>
                        var userList = ".json_encode($userList).";
                        document.getElementById('oldUsername').value = '$row[0]';
                        document.getElementById('newUsername').value = '$row[0]';
                        document.getElementById('name').value = '$row[1]';
                        document.getElementById('email').value = '$row[2]';
                        document.getElementById('phone').value = '$row[3]';
                        document.getElementById('role').value = '$row[4]';
                        document.update.action = 'updateUser.php';
                    </script>";
                }
                $dbConn -> close();
                break;
            case 'feedback':
                if ($result = $dbConn -> query("SELECT Status FROM Feedback WHERE ID = '$id' LIMIT 1;")) {
                    $status = ($result -> fetch_row())[0];
                    switch ($status) {
                        case "Pending":
                            $status = "Resolved";
                            break;
                        case "Resolved":
                            $status = "Pending";
                            break;
                    }
                    if (!$dbConn -> query("UPDATE Feedback SET Status = '$status' WHERE ID = '$id';")) {
                        die("Error Updating Status");
                    }
                    $dbConn -> close();
                    header("location: ./?data=$data");
                    die();
                }
                break;
        }
    }
    header("location: ./");
    die();