<?php
    function compressValue($value)
    {
        if ($value) {
            if ($value & 1023) {
                $unit = 'MB';
            } else {
                $value >>= 10;
                if ($value & 1023) {
                    $unit = 'GB';
                } else {
                    $value >>= 10;
                    $unit = 'TB';
                }
            }
            return "$value $unit";
        }
    }
    if (isset($_GET["laptop"]) && is_int(json_decode($id = $_GET["laptop"]))) {
        require "../headers/dbConn.php";
        if (($result = $dbConn -> query("SELECT Name, Description, ImageAddress, CPUName, CPUManufacturer, CPUScore, GPUName, GPUManufacturer, GPUScore, RAM, MaxRAM, Storage, StorageType, MaxStorage, MaxStorageType, ScreenResolutionWidth, ScreenResolutionHeight, ScreenResolutionUpgradeWidth, ScreenResolutionUpgradeHeight, RefreshRate, ColorAccuracy FROM Laptop WHERE ID = $id LIMIT 1;")) && $dbConn -> affected_rows) {
            include "../headers/navBar.php";
            include "detail.html";

            $row = $result -> fetch_assoc();
            $maxScore = $dbConn -> query("SELECT MAX(CPUScore) AS CPU, MAX(GPUScore) AS GPU, MAX(RAM) AS RAM, MAX(Storage) AS Storage FROM Laptop;") -> fetch_assoc();

            $addOns = "";
            if ($maxRam = $row['MaxRAM']) {
                $addOns .= "<p class='item'><span>-> </span>".compressValue($maxRam)." RAM</p>";
            }
            if (($maxStorage = $row['MaxStorage']) && ($maxStorageType = $row['MaxStorageType'])) {
                $addOns .= "<p class='item'><span>-> </span>".compressValue($maxStorage)." $maxStorageType</p>";
            }
            if (($resolutionUpgradeWidth = $row['ScreenResolutionUpgradeWidth']) && ($resolutionUpgradeHeight = $row['ScreenResolutionUpgradeHeight'])) {
                $addOns .= "<p class='item'><span>-> </span>$resolutionUpgradeWidth x $resolutionUpgradeHeight Display Resolution</p>";
            }
            if (empty($addOns)) {
                $addOns .= "<p class='item'>None</p>";
            }
            $refreshRate = $row['RefreshRate'] ? $row['RefreshRate']." Hz" : "N/A";
            $colorAccuracy = $row['ColorAccuracy'] ? "E < ".$row['ColorAccuracy'] : "N/A";

            echo "<script>
                var image = document.getElementById('laptopImage');
                image.src = ".json_encode("../../image/Laptop Images/".$row['ImageAddress']).";
                image.alt = 'Laptop $id';
                document.getElementById('laptopName').textContent = '".$row['Name']."';

                document.getElementById('cpuRating').setAttribute('data-percent',".($row['CPUScore']/$maxScore['CPU']*100).");
                document.getElementById('gpuRating').setAttribute('data-percent',".($row['GPUScore']/$maxScore['GPU']*100).");
                document.getElementById('ramRating').setAttribute('data-percent',".($row['RAM']/$maxScore['RAM']*100).");
                document.getElementById('storageRating').setAttribute('data-percent',".($row['Storage']/$maxScore['Storage']*100).");

                document.getElementById('description').textContent = ".json_encode($row['Description']).";

                document.getElementById('cpu').textContent = '".$row['CPUManufacturer']." ".$row['CPUName']."';
                document.getElementById('gpu').textContent = '".$row['GPUManufacturer']." ".$row['GPUName']."';
                document.getElementById('ram').textContent = '".compressValue($row['RAM'])."';
                document.getElementById('storage').textContent = '".compressValue($row['Storage'])." ".$row['StorageType']."';
                document.getElementById('resolution').textContent = '".$row['ScreenResolutionWidth']." x ".$row['ScreenResolutionHeight']."';
                document.getElementById('refreshRate').textContent = '$refreshRate';
                document.getElementById('colorAccuracy').textContent = '$colorAccuracy';

                document.getElementById('addOns').innerHTML = `$addOns`;
            </script>";
        } else {
            $dbConn -> close();
            header("location: ./");
            die();
        }
        $dbConn -> close();
    } else {
        header("location: ./");
        die();
    }