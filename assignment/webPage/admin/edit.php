<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../headers/header.php";
        require "../headers/dbConn.php";
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                include "laptopEdit.html";
                echo "<script>updateForm.id.value = $id;</script>";
                $idValue = json_decode($id);
                if (isset($idValue)) {
                    if ($result = $dbConn -> query("SELECT Name,Description,Image,CPUName,CPUManufacturer,CPUScore,GPUName,GPUManufacturer,GPUScore,RAM,Storage,StorageType,ForGaming,ForBusiness,ForArt FROM Laptop WHERE ID = '$id' LIMIT 1;")) {
                        $row = $result -> fetch_row();
                    }
                } else {
                    echo "<script>
                        updateForm.deviceName.setCustomValidity('Device name cannot be empty.');
                        updateForm.description.setCustomValidity('Description cannot be empty.');
                        updateForm.cpuManufacturer.setCustomValidity('Manufacturer name cannot be empty.');
                        updateForm.cpu.setCustomValidity('CPU name cannot be empty.');
                        updateForm.cpuBenchmark.setCustomValidity('CPU benchmark cannot be empty.');
                        updateForm.gpuManufacturer.setCustomValidity('Manufacturer name cannot be empty.');
                        updateForm.gpu.setCustomValidity('GPU name cannot be empty.');
                        updateForm.gpuBenchmark.setCustomValidity('GPU benchmark cannot be empty.');
                        updateForm.ram.setCustomValidity('RAM Capacity cannot be empty.');
                        updateForm.storage.setCustomValidity('Storage Capacity cannot be empty.');
                    </script>";
                }
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
                    $dbConn -> query("UPDATE Feedback SET Status = '$status' WHERE ID = '$id';");
                }
                $dbConn -> close();
                header("location: ./?data=$data");
                die();
        }
    } else {
        header("location: ./");
        die();
    }