<?php

function compressValue(&$value){
    if ($value) {
        if ($value & 1023) {
            return 'MB';
        } else {
            $value >>= 10;
            if ($value & 1023) {
                return 'GB';
            } else {
                $value >>= 10;
                return 'TB';
            }
        }
    }
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../headers/header.php";
        require "../headers/dbConn.php";
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                include "laptopEdit.html";
                echo "<script>
                    updateForm.id.value = $id;";

                function loadData($listID,$db,$query) {
                    echo "var list = document.getElementById('$listID');";
                    if ($result = $db->query($query)) {
                        while ($row = $result->fetch_row()) {
                            echo "var option = document.createElement('option');
                                option.value = '$row[0]';
                                list.appendChild(option);
                            ";
                        }
                    }
                }

                loadData("cpuManufacturerList",$dbConn,"SELECT CPUManufacturer from Laptop GROUP BY CPUManufacturer;");
                loadData("cpuList",$dbConn,"SELECT CPUName from Laptop GROUP BY CPUName;");
                loadData("gpuManufacturerList",$dbConn,"SELECT GPUManufacturer from Laptop GROUP BY GPUManufacturer;");
                loadData("gpuList",$dbConn,"SELECT GPUName from Laptop GROUP BY GPUName;");

                $idValue = json_decode($id);
                if (isset($idValue)) {
                    if ($result = $dbConn -> query("SELECT Name,Description,ImageAddress,CPUName,CPUManufacturer,CPUScore,GPUName,GPUManufacturer,GPUScore,RAM,MaxRAM,Storage,StorageType,MaxStorage,MaxStorageType,ScreenResolutionWidth,ScreenResolutionHeight,ScreenResolutionUpgradeWidth,ScreenResolutionUpgradeHeight,refreshRate,ColorAccuracy,ForGaming,ForBusiness,ForArt FROM Laptop WHERE ID = '$id' LIMIT 1;")) {
                        $row = $result -> fetch_row();
                        $ram = $row[9];
                        $maxRam = $row[10];
                        $storage = $row[11];
                        $maxStorage = $row[13];
                        echo "const imagePreview = document.getElementById('imagePreview_deviceForm');
                            imagePreview.src = ".json_encode("../../image/Laptop Images/$row[2]").";
                            imagePreview.style.display = 'block';
                            fetch(".json_encode("../../image/Laptop Images/$row[2]").")
                            .then(res => res.blob())
                            .then(blob => {
                                const file = new File([blob], ".json_encode($row[2]).", blob);
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                document.getElementById('image').files = dataTransfer.files;
                            });
                            updateForm.deviceName.value = '$row[0]';
                            updateForm.description.value = ".json_encode(htmlspecialchars_decode($row[1])).";
                            updateForm.cpu.value = '$row[3]';
                            updateForm.cpuManufacturer.value = '$row[4]';
                            updateForm.cpuBenchmark.value = '$row[5]';
                            updateForm.gpu.value = '$row[6]';
                            updateForm.gpuManufacturer.value = '$row[7]';
                            updateForm.gpuBenchmark.value = $row[8];
                            updateForm.ramUnit.value = '".compressValue($ram)."';
                            updateForm.ram.value = $ram;
                            updateForm.maxRamUnit.value = '".compressValue($maxRam)."';
                            updateForm.maxRam.value = ".json_encode($maxRam).";
                            updateForm.storageUnit.value = '".compressValue($storage)."';
                            updateForm.storage.value = $storage;
                            updateForm.storageType.value = ".json_encode($row[12]).";
                            updateForm.maxStorageUnit.value = '".compressValue($maxStorage)."';
                            updateForm.maxStorage.value = ".json_encode($maxStorage).";
                            updateForm.maxStorageType.value = ".json_encode($row[14]).";
                            updateForm.resolutionWidth.value = $row[15];
                            updateForm.resolutionHeight.value = $row[16];
                            updateForm.resolutionUpgradeWidth.value = ".json_encode($row[17]).";
                            updateForm.resolutionUpgradeHeight.value = ".json_encode($row[18]).";
                            updateForm.refreshRate.value = ".json_encode($row[19]).";
                            updateForm.colorAccuracy.value = ".json_encode($row[20]).";
                            updateForm.forGaming.checked = $row[21];
                            updateForm.forBusiness.checked = $row[22];
                            updateForm.forArt.checked = $row[23];";
                    }
                } else {
                    echo "updateForm.deviceName.setCustomValidity('Device name cannot be empty.');
                        updateForm.description.setCustomValidity('Description cannot be empty.');
                        updateForm.cpuManufacturer.setCustomValidity('Manufacturer name cannot be empty.');
                        updateForm.cpu.setCustomValidity('CPU name cannot be empty.');
                        updateForm.cpuBenchmark.setCustomValidity('CPU benchmark cannot be empty.');
                        updateForm.gpuManufacturer.setCustomValidity('Manufacturer name cannot be empty.');
                        updateForm.gpu.setCustomValidity('GPU name cannot be empty.');
                        updateForm.gpuBenchmark.setCustomValidity('GPU benchmark cannot be empty.');
                        updateForm.ram.setCustomValidity('RAM capacity cannot be empty.');
                        updateForm.storage.setCustomValidity('Storage capacity cannot be empty.');
                        updateForm.resolutionWidth.setCustomValidity('Screen resolution width cannot be empty.');
                        updateForm.resolutionHeight.setCustomValidity('Screen resolution height cannot be empty.');";
                }
                echo "</script>";
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
        $dbConn -> close();
    } else {
        header("location: ./");
        die();
    }