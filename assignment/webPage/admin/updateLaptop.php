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
        $storage = $_POST['storage'];
        $storageUnit = $_POST['storageUnit'];
        $storageType = $_POST['storageType'];

        $forGaming = isset($_POST['forGaming']);
        $forBusiness = isset($_POST['forBusiness']);
        $forArt = isset($_POST['forArt']);

        switch ($ramUnit) {
            case "GB":
                $ram <<= 10;
                break;
            case "TB":
                $ram <<= 20;
                break;
        }

        switch ($storageUnit) {
            case "GB":
                $storage <<= 10;
                break;
            case "TB":
                $storage <<= 20;
                break;
        }

        $newImageDir = "../../image/Laptop Images/".$image["name"];
        if (move_uploaded_file($image["tmp_name"],$newImageDir)) {
            require "../headers/dbConn.php";

            $sql = isset($id) ? "UPDATE Laptop SET
                Name='$name',
                Description='$description',
                ImageAddress='".$image["name"]."',
                CPUName='$cpu',
                CPUManufacturer='$cpuManufacturer',
                CPUScore='$cpuScore',
                GPUName='$gpu',
                GPUManufacturer='$gpuManufacturer',
                GPUScore='$gpuScore',
                RAM='$ram',
                Storage='$storage',
                StorageType='$storageType',
                ForGaming=".json_encode($forGaming).",
                ForBusiness=".json_encode($forBusiness).",
                ForArt=".json_encode($forArt)."
                WHERE ID='$id';" :
                "INSERT INTO Laptop(Name,Description, ImageAddress, CPUName, CPUManufacturer, CPUScore, GPUName, GPUManufacturer, GPUScore, RAM, Storage, StorageType, ForGaming, ForBusiness, ForArt)
                VALUES ('$name',
                '$description',
                '$newImageDir',
                '$cpu',
                '$cpuManufacturer',
                $cpuScore,
                '$gpu',
                '$gpuManufacturer',
                $gpuScore,
                $ram,
                $storage,
                '$storageType',"
                .json_encode($forGaming).","
                .json_encode($forBusiness).","
                .json_encode($forArt).");";

            echo $sql;
            if (!$dbConn -> query($sql)) {
                die("Failed to update Laptop table");
            }
            $dbConn -> close();
        }
    }
    header("location: ./?data=laptop");
    die();
