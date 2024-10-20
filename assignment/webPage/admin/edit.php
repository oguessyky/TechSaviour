<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include "../headers/header.php";
        require "../headers/dbConn.php";
        $data = $_POST['data'];
        $id = $_POST['id'];
        switch ($data) {
            case 'laptop':
                include "laptopEdit.html";
                echo "<script>
                    updateForm.id.value = $id;
                    var cpuManufacturerList = document.getElementById('cpuManufacturerList');
                    var cpuList = document.getElementById('cpuList');
                    var gpuManufacturerList = document.getElementById('gpuManufacturerList');
                    var gpuList = document.getElementById('gpuList');
                ";
            
                if ($result = $dbConn->query("SELECT CPUManufacturer from Laptop GROUP BY CPUManufacturer;")) {
                    while ($row = $result->fetch_row()) {
                        echo "var option = document.createElement('option');
                            option.value = '$row[0]';
                            cpuManufacturerList.appendChild(option);
                        ";
                    }
                }
            
                if ($result = $dbConn->query("SELECT CPUName from Laptop GROUP BY CPUName;")) {
                    while ($row = $result->fetch_row()) {
                        echo "var option = document.createElement('option');
                            option.value = '$row[0]';
                            cpuList.appendChild(option);
                        ";
                    }
                }
            
                if ($result = $dbConn->query("SELECT GPUManufacturer from Laptop GROUP BY GPUManufacturer;")) {
                    while ($row = $result->fetch_row()) {
                        echo "var option = document.createElement('option');
                            option.value = '$row[0]';
                            gpuManufacturerList.appendChild(option);
                        ";
                    }
                }
            
                if ($result = $dbConn->query("SELECT GPUName from Laptop GROUP BY GPUName;")) {
                    while ($row = $result->fetch_row()) {
                        echo "var option = document.createElement('option');
                            option.value = '$row[0]';
                            gpuList.appendChild(option);
                        ";
                    }
                }
            
                $idValue = json_decode($id);
                if (isset($idValue)) {
                    if ($result = $dbConn->query("SELECT Name, Description, ImageAddress, CPUName, CPUManufacturer, CPUScore, GPUName, GPUManufacturer, GPUScore, RAM, Storage, StorageType, ForGaming, ForBusiness, ForArt, MAX_RAM, MAX_Storage, MAX_StorageType, ScreenResolution, AddOn_ScreenResolution, Refresh_Rate, ColorAccuracy FROM Laptop WHERE ID = '$id' LIMIT 1;")) {
                        $row = $result->fetch_row();
                        $ram = $row[9];
                        $storage = $row[10];
                        $max_ram = $row[15];
                        $max_storage = $row[16];
            
                        // RAM unit conversion
                        if ($ram & 1023) {
                            echo "updateForm.ramUnit.value = 'MB';";
                        } else {
                            $ram >>= 10;
                            if ($ram & 1023) {
                                echo "updateForm.ramUnit.value = 'GB';";
                            } else {
                                $ram >>= 10;
                                echo "updateForm.ramUnit.value = 'TB';";
                            }
                        }
            
                        // Storage unit conversion
                        if ($storage & 1023) {
                            echo "updateForm.storageUnit.value = 'MB';";
                        } else {
                            $storage >>= 10;
                            if ($storage & 1023) {
                                echo "updateForm.storageUnit.value = 'GB';";
                            } else {
                                $storage >>= 10;
                                echo "updateForm.storageUnit.value = 'TB';";
                            }
                        }
            
                        // MAX_RAM unit conversion
                        if ($max_ram !== null) {
                            if ($max_ram & 1023) {
                                echo "updateForm.maxramUnit.value = 'MB';";
                            } else {
                                $max_ram >>= 10;
                                if ($max_ram & 1023) {
                                    echo "updateForm.maxramUnit.value = 'GB';";
                                } else {
                                    $max_ram >>= 10;
                                    echo "updateForm.maxramUnit.value = 'TB';";
                                }
                            }
                        }
            
                        // MAX_Storage unit conversion
                        if ($max_storage !== null) {
                            if ($max_storage & 1023) {
                                echo "updateForm.maxstorageUnit.value = 'MB';";
                            } else {
                                $max_storage >>= 10;
                                if ($max_storage & 1023) {
                                    echo "updateForm.maxstorageUnit.value = 'GB';";
                                } else {
                                    $max_storage >>= 10;
                                    echo "updateForm.maxstorageUnit.value = 'TB';";
                                }
                            }
                        }
            
                        // Resolution handling
                        list($resolutionWidth, $resolutionHeight) = explode(" x ", $row[18]);
                        echo "updateForm.resolution.value = '$resolutionWidth';";
                        echo "updateForm.resolution2.value = '$resolutionHeight';";
            
                        // Additional resolution handling
                        if (!is_null($row[19])) {
                            list($additionalResolutionWidth, $additionalResolutionHeight) = explode(" x ", $row[19]);
                            echo "updateForm.resolution3.value = '$additionalResolutionWidth';";
                            echo "updateForm.resolution4.value = '$additionalResolutionHeight';";
                        }
            
                        // Refresh Rate and Color Accuracy
                        if (!is_null($row[20])) {
                            echo "updateForm.RefreshRate.value = '$row[20]';";
                        }
                        if (!is_null($row[21])) {
                            echo "updateForm.color_accuracy.value = '$row[21]';";
                        }
            
                        // Image and other fields
                        echo "const imagePreview = document.getElementById('imagePreview_deviceForm');
                            imagePreview.src = '../../image/Laptop Images/$row[2]';
                            imagePreview.style.display = 'block';
                            fetch('../../image/Laptop Images/$row[2]')
                            .then(res => res.blob())
                            .then(blob => {
                                const file = new File([blob], '$row[2]', { type: blob.type });
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                document.getElementById('image').files = dataTransfer.files;
                            });
                            updateForm.deviceName.value = '$row[0]';
                            updateForm.description.value = `$row[1]`;
                            updateForm.cpu.value = '$row[3]';
                            updateForm.cpuManufacturer.value = '$row[4]';
                            updateForm.cpuBenchmark.value = '$row[5]';
                            updateForm.gpu.value = '$row[6]';
                            updateForm.gpuManufacturer.value = '$row[7]';
                            updateForm.gpuBenchmark.value = '$row[8]';
                            updateForm.ram.value = '$ram';
                            updateForm.maxram.value = '$max_ram';
                            updateForm.storage.value = '$storage';
                            updateForm.maxstorage.value = '$max_storage';
                            updateForm.forGaming.checked = $row[12];
                            updateForm.forBusiness.checked = $row[13];
                            updateForm.forArt.checked = $row[14];
                        ";
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
                        updateForm.ram.setCustomValidity('RAM Capacity cannot be empty.');
                        updateForm.storage.setCustomValidity('Storage Capacity cannot be empty.');
                    ";
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