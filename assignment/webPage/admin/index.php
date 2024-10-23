<?php
    include "../headers/header.php";
    if (!$isSet || $role != 'Admin') {
        header("location: ../home/");
        die();
    }
    include "adminPage.html";
?>
<script>
    searchInput = document.getElementById('search');
    <?php
        if (isset($_GET["data"])) {
            require "../headers/dbConn.php";
            $data = $_GET["data"];
            if (in_array($data,["laptop","user","feedback"])) {
                echo "handleButtonClick(document.getElementById('$data'));
                var searchList = document.getElementById('searchList');
                document.getElementById('data').value = '$data';
                document.getElementById('getData').value = '$data';
                document.getElementById('getSearchData').value = '$data';";
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];
                    echo "searchInput.value = '$search';";
                }
                $tableContent = "";
                switch ($data) {
                    case "laptop":
                        echo "searchInput.placeholder = 'Search laptop name...';";
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Image</th>
                                <th>Device Name</th>
                                <th>CPU</th>
                                <th>GPU</th>
                                <th>RAM</th>
                                <th>Storage</th>
                                <th colspan='2'>Edit</th>
                            </tr>
                        </thead>
                        <tbody>";

                        $searchListQuery = "SELECT Name FROM Laptop GROUP BY Name;";
                        
                        $sql =
                        "SELECT ID,ImageAddress,Name,CPUName,GPUName,RAM,Storage FROM Laptop";
                        if (isset($search)) {
                            $sql .= " WHERE Name LIKE '%$search%';";
                        } else {
                            $sql .= ";";
                        }
                        if ($result = $dbConn -> query($sql)) {
                            while ($row = $result -> fetch_row()) {
                                $tableContent .= '<tr onclick="'."prepareEdit('$row[0]');".'">';
                                $tableContent .= "<td><img src=".json_encode("../../image/Laptop Images/$row[1]")." alt='Laptop $row[0]' class='responsive-img'></td>";
                                foreach (array_slice($row,2,3) as $element) {
                                    $tableContent .= "<td>$element</td>";
                                }
                                foreach (array_slice($row,5) as $element) {
                                    if ($element & 1023) {
                                        $unit = 'MB';
                                    } else {
                                        $element >>= 10;
                                        if ($element & 1023) {
                                            $unit = 'GB';
                                        } else {
                                            $element >>= 10;
                                            $unit = 'TB';
                                        }
                                    }
                                    $tableContent .= "<td>$element $unit</td>";
                                }
                                $tableContent .= '<td><button type="button"><svg fill="#85ff9d" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 494.936 494.936" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157 c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21 s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741 c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"></path> <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069 c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963 c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692 C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107 l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005 c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"></path> </g> </g> </g></svg></button></td>';
                                $tableContent .= '<td><button type="button" onclick="showPopUp();"><svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button></td>';
                                $tableContent .= "</tr>";
                            }
                        }
                        break;

                    case "user":
                        echo "searchInput.placeholder = 'Search user name...';";
                        echo "addIcon.style.display = 'none';";
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th colspan='2'>Edit</th>
                            </tr>
                        </thead>
                        <tbody>";

                        $searchListQuery = "SELECT Name FROM User WHERE Username != '$username' GROUP BY Name;";

                        $sql = "SELECT Username,Name,Role,Email,Phone FROM User WHERE Username != '$username'";
                        if (isset($search)) {
                            $sql .= " AND Name LIKE '%$search%';";
                        } else {
                            $sql .= ";";
                        }

                        if ($result = $dbConn -> query($sql)) {
                            while ($row = $result -> fetch_row()) {
                                $tableContent .= '<tr onclick="'."prepareEdit('$row[0]');".'">';
                                foreach ($row as $element) {
                                    $tableContent .= "<td>$element</td>";
                                }
                                $tableContent .= '<td><button type="button"><svg fill="#85ff9d" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 494.936 494.936" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157 c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21 s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741 c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"></path> <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069 c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963 c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692 C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107 l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005 c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"></path> </g> </g> </g></svg></button></td>';
                                $tableContent .= '<td><button type="button" onclick="showPopUp();"><svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button></td>';
                                $tableContent .= "</tr>";
                            }
                        }
                        break;

                    case "feedback":
                        echo "searchInput.placeholder = 'Search user name...';";
                        echo "addIcon.style.display = 'none';";
                        $tableContent .=
                        "<thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Inquiry</th>
                                <th>Status</th>
                                <th colspan='2'>Edit</th>
                            </tr>
                        </thead>
                        <tbody>";

                        $searchListQuery = "SELECT User.Name FROM Feedback LEFT JOIN User ON Feedback.Username = User.Username GROUP BY User.Name;";

                        $sql =
                        "SELECT Feedback.ID,Feedback.Username,User.Name,User.Email,User.Phone,Feedback.Inquiry,Feedback.Status FROM Feedback
                        LEFT JOIN User ON Feedback.Username = User.Username";
                        if (isset($search)) {
                            $sql .= " WHERE User.Name LIKE '%$search%';";
                        } else {
                            $sql .= ";";
                        }

                        if ($result = $dbConn -> query($sql)) {
                            while ($row = $result -> fetch_row()) {
                                $tableContent .= '<tr onclick="'."prepareEdit('$row[0]');".'">';
                                foreach (array_slice($row,1) as $element) {
                                    $tableContent .= "<td>`+".json_encode($element)."+`</td>";
                                }
                                $tableContent .= '<td><button type="button"><svg fill="#85ff9d" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 494.936 494.936" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157 c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21 s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741 c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"></path> <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069 c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963 c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692 C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107 l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005 c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"></path> </g> </g> </g></svg></button></td>';
                                $tableContent .= '<td><button type="button" onclick="showPopUp();"><svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 7V18C6 19.1046 6.89543 20 8 20H16C17.1046 20 18 19.1046 18 18V7M6 7H5M6 7H8M18 7H19M18 7H16M10 11V16M14 11V16M8 7V5C8 3.89543 8.89543 3 10 3H14C15.1046 3 16 3.89543 16 5V7M8 7H16" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button></td>';
                                $tableContent .= "</tr>";
                            }
                        }
                        break;
                }
                if ($result = $dbConn -> query($searchListQuery)) {
                    while ($row = $result -> fetch_row()) {
                        echo "var option = document.createElement('option');
                        option.value = '$row[0]';
                        searchList.appendChild(option);";
                    }
                }
                $tableContent .= "</tbody>";
                echo "document.getElementById('adminTable').innerHTML = `$tableContent`;";
            }
            $dbConn -> close();
        }
    ?>
</script>

