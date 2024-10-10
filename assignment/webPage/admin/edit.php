<?php
    echo"";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../headers/header.php";
        require "../headers/dbConn.php";
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                break;
            case 'user':
                include "userEdit.html";
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
                    header("location: ./?data=$data");
                    die();
                }
                break;
        }
    } else {
        header("location: ./");
        die();
    }