<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = json_decode($_POST['id']);
    $image = $_FILES['image'];
    $name = $_POST['deviceName'];
    $description = $_POST['description'];
    $cpu = $_POST['cpu'];
    $cpuManufacturer = $_POST['cpuManufacturer'];
    $cpuScore = $_POST['cpuBenchmark'];
    $gpu = $_POST['gpu'];
    $gpuManufacturer = $_POST['gpuManufacturer'];
    $gpuScore = $_POST['gpuBenchmark'];
    $ram = $_POST['ram'];
    $ramUnit = $_POST['ramUnit'];
    $maxRam = $_POST['maxram'] ?: null;
    $maxRamUnit = $_POST['maxramUnit'] ?: null;
    $storage = $_POST['storage'];
    $storageUnit = $_POST['storageUnit'];
    $maxStorage = $_POST['maxstorage'] ?: null;
    $maxStorageUnit = $_POST['maxstorageUnit'] ?: null;
    $maxStorageType = $_POST['maxstorageType'] ?: null;
    $storageType = $_POST['storageType'];
    $resolutionWidth = $_POST['resolution'];
    $resolutionHeight = $_POST['resolution2'];
    $resolution = $resolutionWidth . " x " . $resolutionHeight;
    $resolutionWidthAdd = $_POST['resolution3'] ?: null;
    $resolutionHeightAdd = $_POST['resolution4'] ?: null;
    $additionalResolution = $resolutionWidthAdd && $resolutionHeightAdd ? $resolutionWidthAdd . " x " . $resolutionHeightAdd : null;
    $fps = $_POST['fps'] ?: null;
    $colorAccuracy = $_POST['color_accuracy'] ?: null;
    $forGaming = isset($_POST['forGaming']);
    $forBusiness = isset($_POST['forBusiness']);
    $forArt = isset($_POST['forArt']);

    // Convert units and set to appropriate variables
    function convertUnit(&$value, $unit)
    {
        switch ($unit) {
            case "GB":
                $value <<= 10;
                break;
            case "TB":
                $value <<= 20;
                break;
        }
    }
    convertUnit($ram, $ramUnit);
    if ($maxRam) convertUnit($maxRam, $maxRamUnit);
    convertUnit($storage, $storageUnit);
    if ($maxStorage) convertUnit($maxStorage, $maxStorageUnit);

    $newImageDir = "../../image/Laptop Images/" . $image["name"];
    if (move_uploaded_file($image["tmp_name"], $newImageDir)) {
        require "../headers/dbConn.php";

        $sql = isset($id) ?
            "UPDATE Laptop SET
            Name = '$name',
            Description = '$description',
            ImageAddress = '" . basename($image["name"]) . "',
            CPUName = '$cpu',
            CPUManufacturer = '$cpuManufacturer',
            CPUScore = '$cpuScore',
            GPUName = '$gpu',
            GPUManufacturer = '$gpuManufacturer',
            GPUScore = '$gpuScore',
            RAM = '$ram',
            MAX_RAM = " . ($maxRam ? "'$maxRam'" : "NULL") . ",
            Storage = '$storage',
            StorageType = '$storageType',   
            MAX_Storage = " . ($maxStorage ? "'$maxStorage'" : "NULL") . ",
            MAX_StorageType = " . ($maxStorageType ? "'$maxStorageType'" : "NULL") . ",
            ScreenResolution = '$resolution',
            AddOn_ScreenResolution = " . ($additionalResolution ? "'$additionalResolution'" : "NULL") . ",
            FPS = " . ($fps ? "'$fps'" : "NULL") . ",
            ColorAccuracy = " . ($colorAccuracy ? "'$colorAccuracy'" : "NULL") . ",
            ForGaming = " . json_encode($forGaming) . ",
            ForBusiness = " . json_encode($forBusiness) . ",
            ForArt = " . json_encode($forArt) . "
        WHERE ID = '$id';" :
            "INSERT INTO Laptop (
            Name, 
            Description, 
            ImageAddress, 
            CPUName, 
            CPUManufacturer, 
            CPUScore,
            GPUName, 
            GPUManufacturer, 
            GPUScore, 
            RAM, 
            MAX_RAM, 
            Storage, 
            StorageType,
            MAX_Storage, 
            MAX_StorageType,
            ScreenResolution, 
            AddOn_ScreenResolution, 
            FPS, 
            ColorAccuracy, 
            ForGaming, 
            ForBusiness, 
            ForArt
        ) VALUES (
            '$name', 
            '$description', 
            '" . basename($image["name"]) . "',
            '$cpu', 
            '$cpuManufacturer', 
            $cpuScore, 
            '$gpu', 
            '$gpuManufacturer', 
            $gpuScore, 
            $ram, 
            " . ($maxRam ? "'$maxRam'" : "NULL") . ", 
            $storage, 
            '$storageType', 
            " . ($maxStorage ? "'$maxStorage'" : "NULL") . ", 
            " . ($maxStorageType ? "'$maxStorageType'" : "NULL") . ",
            '$resolution', 
            " . ($additionalResolution ? "'$additionalResolution'" : "NULL") . ", 
            " . ($fps ? "'$fps'" : "NULL") . ", 
            " . ($colorAccuracy ? "'$colorAccuracy'" : "NULL") . ", 
            " . json_encode($forGaming) . ", 
            " . json_encode($forBusiness) . ", 
            " . json_encode($forArt) . "
        );";

        echo $sql;
        if (!$dbConn->query($sql)) {
            die("Failed to update Laptop table");
        }
        $dbConn->close();
    }
}
header("Location: ./?data=laptop");
die();
