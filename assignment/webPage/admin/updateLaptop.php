<?php
    function convertUnit($value, $unit)
    {
        if (isset($value) & isset($unit)) {
            switch ($unit) {
                case "MB":
                    return $value;
                case "GB":
                    $value <<= 10;
                    return $value;
                case "TB":
                    $value <<= 20;
                    return $value;
                default:
                    throw new InvalidArgumentException("Unknown unit");
            }
        } else {
            return null;
        }
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = json_decode($_POST['id']);
    $image = $_FILES['image'];
    $name = $_POST['deviceName'];
    $description = htmlspecialchars($_POST['description']);
    $cpu = $_POST['cpu'];
    $cpuManufacturer = $_POST['cpuManufacturer'];
    $cpuScore = $_POST['cpuBenchmark'];
    $gpu = $_POST['gpu'];
    $gpuManufacturer = $_POST['gpuManufacturer'];
    $gpuScore = $_POST['gpuBenchmark'];
    $ram = convertUnit($_POST['ram'],$_POST['ramUnit']);

    $maxRam = json_encode(convertUnit(json_decode($_POST['maxRam']),$_POST['maxRamUnit']));
    
    $storage = convertUnit($_POST['storage'],$_POST['storageUnit']);
    $storageType = $_POST['storageType'];
    
    $maxStorage = convertUnit(json_decode($_POST['maxStorage']),$_POST['maxStorageUnit']);
    $maxStorageType = json_encode($maxStorage ? $_POST['maxStorageType'] : null);
    $maxStorage = json_encode($maxStorage);

    $resolutionWidth = $_POST['resolutionWidth'];
    $resolutionHeight = $_POST['resolutionHeight'];

    $resolutionUpgradeWidth = json_decode($_POST['resolutionUpgradeWidth']);
    $resolutionUpgradeHeight = json_decode($_POST['resolutionUpgradeHeight']);
    if (!($resolutionUpgradeWidth & $resolutionUpgradeHeight)) {
        $resolutionUpgradeWidth = json_encode(null);
        $resolutionUpgradeHeight = json_encode(null);
    }
    $fps = json_encode(json_decode($_POST['fps']));
    $colorAccuracy = json_encode(json_decode($_POST['colorAccuracy']));

    $forGaming = json_encode(isset($_POST['forGaming']));
    $forBusiness = json_encode(isset($_POST['forBusiness']));
    $forArt = json_encode(isset($_POST['forArt']));

    $newImageDir = "../../image/Laptop Images/" . $image["name"];
    if (move_uploaded_file($image["tmp_name"], $newImageDir)) {
        require "../headers/dbConn.php";

        $sql = isset($id) ?
            "UPDATE Laptop SET
            Name = '$name',
            Description = '$description',
            ImageAddress = ".json_encode(basename($image["name"])).",
            CPUName = '$cpu',
            CPUManufacturer = '$cpuManufacturer',
            CPUScore = $cpuScore,
            GPUName = '$gpu',
            GPUManufacturer = '$gpuManufacturer',
            GPUScore = $gpuScore,
            RAM = $ram,
            MaxRAM = $maxRam,
            Storage = $storage,
            StorageType = '$storageType',
            MaxStorage = $maxStorage,
            MaxStorageType = $maxStorageType,
            ScreenResolutionWidth = $resolutionWidth,
            ScreenResolutionHeight = $resolutionHeight,
            ScreenResolutionUpgradeWidth = $resolutionUpgradeWidth,
            ScreenResolutionUpgradeHeight = $resolutionUpgradeHeight,
            FPS = $fps,
            ColorAccuracy = $colorAccuracy,
            ForGaming = $forGaming,
            ForBusiness = $forBusiness,
            ForArt = $forArt
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
            MaxRAM, 
            Storage, 
            StorageType,
            MaxStorage, 
            MaxStorageType,
            ScreenResolutionWidth,
            ScreenResolutionHeight,
            ScreenResolutionUpgradeWidth,
            ScreenResolutionUpgradeHeight,
            FPS, 
            ColorAccuracy, 
            ForGaming, 
            ForBusiness, 
            ForArt
        ) VALUES (
            '$name', 
            '$description', 
            ".json_encode(basename($image["name"])).",
            '$cpu', 
            '$cpuManufacturer', 
            $cpuScore, 
            '$gpu', 
            '$gpuManufacturer', 
            $gpuScore, 
            $ram, 
            $maxRam, 
            $storage, 
            '$storageType', 
            $maxStorage, 
            $maxStorageType,
            $resolutionWidth,
            $resolutionHeight,
            $resolutionUpgradeWidth,
            $resolutionUpgradeHeight,
            $fps, 
            $colorAccuracy, 
            $forGaming, 
            $forBusiness, 
            $forArt
        );";
        if (!$dbConn->query($sql)) {
            die("Failed to update Laptop table");
        }
        $dbConn->close();
    }
}
header("Location: ./?data=laptop");
die();