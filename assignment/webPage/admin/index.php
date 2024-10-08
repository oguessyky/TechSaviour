<?php
    include "../headers/header.php";
    if (!$isSet || $role != 'Admin') {
        header("location: ../home/");
        die();
    }
    include "adminPage1.html";
    include "../headers/dbConn.php";
?>
<script>
    <?php
        if (isset($_GET["data"])) {
            $data = $_GET["data"];
            if (in_array($data,["laptop","user","feedback"])) {
                echo "handleButtonClick(document.getElementById('$data'));";
                $tableContent = "";
                switch ($data) {
                    case "laptop":
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Image</th>
                                <th>Device Name</th>
                                <th>Detail</th>
                                <th>CPU</th>
                                <th>GPU</th>
                                <th>RAM</th>
                                <th>Storage</th>
                                <th>Remove</th>
                            </tr>
                        </thead>";

                        $sql =
                        "SELECT Laptop.Image,Laptop.Name,Laptop.Description,CPU.Name,GPU.Name,Laptop.RAM,Laptop.Storage FROM Laptop
                        LEFT JOIN CPU ON Laptop.CPU = CPU.ID
                        LEFT JOIN GPU ON Laptop.GPU = GPU.ID";
                        if (isset($_GET["search"])) {
                            $sql .= " WHERE Laptop.Name LIKE %".$_GET["search"]."%;";
                        } else {
                            $sql .= ";";
                        }
                        break;

                    case "user":
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Remove</th>
                            </tr>
                        </thead>";

                        $sql = "SELECT Username,Name,Role,Email,Phone FROM User";
                        if (isset($_GET["search"])) {
                            $sql .= " WHERE Name LIKE %".$_GET["search"]."%;";
                        } else {
                            $sql .= ";";
                        }
                        break;

                    case "feedback":
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Inquiry</th>
                                <th>Status</th>
                                <th>Remove</th>
                            </tr>
                        </thead>";
                        break;
                }
                // if ($result = $dbConn -> query($sql)) {
                //     while ($row = $result -> fetch_row()) {
                //         $tableContent .= "<tr>";
                //         foreach ($row as $element) {
                //             $tableContent .= "<th>".$element."</th>";
                //         }
                //         $tableContent .= "</tr>";
                //     }
                // }
                echo "document.getElementById('adminTable').innerHTML = `$tableContent`;";
            }
        }
    ?>
</script>