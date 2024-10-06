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
        if (in_array($data,["laptop","user","feedback"]))
            echo "handleButtonClick(document.getElementById('$data'));";
            if (isset($_GET["search"])) {
                $search = " WHERE Name LIKE %".$_GET["search"]."%";
            } else {
                $search = "";
            }
        switch ($data) {
            case "laptop":
                echo
                "document.getElementById('adminTable').innerHTML = `
                    <thead>
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
                    </thead>`";
                // if ($result = $dbConn -> query("SELECT Image,Name,Description,CPU,GPU,RAM,Storage FROM Laptop".$search.";")) {
                //     $a = $result -> fetch_array(MYSQLI_ASSOC);
                // }
                break;
            case "user":
                echo
                "document.getElementById('adminTable').innerHTML = `
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Remove</th>
                        </tr>
                    </thead>`;";
                break;
            case "feedback":
                echo
                "document.getElementById('adminTable').innerHTML = `
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Inquiry</th>
                            <th>Status</th>
                            <th>Remove</th>
                        </tr>
                    </thead>`;";
                break;
        }
    }
?>
</script>