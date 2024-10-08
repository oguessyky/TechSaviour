<?php
    $header = "location: ./";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                $sql = "DELETE FROM Laptop WHERE ID = '$id'";
                break;
            case 'user':
                $sql = "DELETE FROM User WHERE Username = '$id'";
                break;
            case 'feedback':
                $sql = "DELETE FROM Feedback WHERE ID = '$id'";
                break;
        }
        $header .= "?data=$data";
        require "../headers/dbConn.php";
        if (!$dbConn -> query($sql)) {
            die("Error Deleting");
        }
    }
    header($header);
    die();