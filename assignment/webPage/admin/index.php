<?php
    include "../headers/header.php";
    if (!$isSet || $role != 'Admin') {
        header("location: ../home/");
        die();
    }
    include "adminPage1.html";
    include "../headers/dbConn.php";
    if (isset($_GET["data"])) {
        $data = $_GET["data"];
        if (in_array($data,["laptop","user","feedback"]))
            echo "<script>handleButtonClick(document.getElementById('$data'));</script>";
        switch ($data) {
            case "laptop":
                echo
                "<script>
                    document.getElementById('adminTable').innerHTML = `
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
                    </thead>`;
                </script>";
                if ($result = $dbConn -> query("SELECT Image,Name,")) {

                }
                break;
            case "user":
                echo
                "<script>
                    document.getElementById('adminTable').innerHTML = `
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Remove</th>
                        </tr>
                    </thead>`;
                </script>";
                break;
            case "feedback":
                echo
                "<script>
                    document.getElementById('adminTable').innerHTML = `
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
                    </thead>`;
                </script>";
                break;
        }
    }
