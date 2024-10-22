<?php
    include "../headers/navBar.php";
    require "../headers/dbConn.php";
    if (isset($_GET['category']) && in_array($category = $_GET['category'],["gaming","business","art"])) {
        include "category.html";

        switch ($category) {
            case "gaming":
                $description = "These type of computer have strong processing power to run various task been given";
                break;
            case "business":
                $description = "These type of computer have long battery life, that can let them standby the whole day";
                break;
            case "art":
                $description = "These type of computer ensure the accuracy of the display quality to syn the color in the real world";
                break;
        }

        $content = "";
        if ($result = $dbConn -> query("SELECT ID,Name,ImageAddress,CPUScore,GPUScore,Ram,Storage FROM Laptop WHERE For".ucfirst($category).";")) {
            $maxScore = $dbConn -> query("SELECT MAX(CPUScore) AS CPU, MAX(GPUScore) AS GPU, MAX(RAM) AS RAM, MAX(Storage) AS Storage FROM Laptop;") -> fetch_assoc();
            while ($row = $result -> fetch_assoc()) {
                $content .=
                "<a href='detail.php?laptop=".$row['ID']."'>
                    <div class='all-content'>
                        <div class='component-img'>
                            <img src=".json_encode("../../image/Laptop Images/".$row['ImageAddress'])." alt='Laptop ".$row['ID']."'>
                        </div>
                        <div class='component-detail'>
                            <h2>".$row['Name']."</h2>
                            <div class='component-cpu'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 128 128'><g><path d='M88.873,29.763a1.752,1.752,0,0,0-1.238-.513H40.365a1.752,1.752,0,0,0-1.238.513l-9.364,9.364a1.752,1.752,0,0,0-.513,1.238v47.27a1.752,1.752,0,0,0,.513,1.238l9.364,9.364a1.752,1.752,0,0,0,1.238.513h47.27a1.752,1.752,0,0,0,1.238-.513l9.364-9.364a1.752,1.752,0,0,0,.513-1.238V40.365a1.752,1.752,0,0,0-.513-1.238ZM95.25,86.91l-8.34,8.34H41.09l-8.34-8.34V41.09l8.34-8.34H86.91l8.34,8.34Z'/><path d='M121,53.417a1.75,1.75,0,0,0,0-3.5H110.75V41.083H121a1.75,1.75,0,0,0,0-3.5H110.75V23.5a6.257,6.257,0,0,0-6.25-6.25H90.416V7a1.75,1.75,0,0,0-3.5,0V17.25H78.083V7a1.75,1.75,0,0,0-3.5,0V17.25H65.75V7a1.75,1.75,0,0,0-3.5,0V17.25H53.416V7a1.75,1.75,0,0,0-3.5,0V17.25H41.083V7a1.75,1.75,0,0,0-3.5,0V17.25H23.5a6.257,6.257,0,0,0-6.25,6.25V37.583H7a1.75,1.75,0,0,0,0,3.5H17.25v8.834H7a1.75,1.75,0,0,0,0,3.5H17.25V62.25H7a1.75,1.75,0,0,0,0,3.5H17.25v8.833H7a1.75,1.75,0,0,0,0,3.5H17.25v8.834H7a1.75,1.75,0,0,0,0,3.5H17.25V104.5a6.257,6.257,0,0,0,6.25,6.25H37.583V121a1.75,1.75,0,0,0,3.5,0V110.75h8.833V121a1.75,1.75,0,0,0,3.5,0V110.75H62.25V121a1.75,1.75,0,0,0,3.5,0V110.75h8.833V121a1.75,1.75,0,0,0,3.5,0V110.75h8.833V121a1.75,1.75,0,0,0,3.5,0V110.75H104.5a6.257,6.257,0,0,0,6.25-6.25V90.417H121a1.75,1.75,0,0,0,0-3.5H110.75V78.083H121a1.75,1.75,0,0,0,0-3.5H110.75V65.75H121a1.75,1.75,0,0,0,0-3.5H110.75V53.417ZM107.25,104.5a2.754,2.754,0,0,1-2.75,2.75h-81a2.754,2.754,0,0,1-2.75-2.75v-81a2.754,2.754,0,0,1,2.75-2.75h81a2.754,2.754,0,0,1,2.75,2.75Z'/><path d='M43,57.75h8a1.75,1.75,0,0,0,0-3.5H43A5.757,5.757,0,0,0,37.25,60v8A5.757,5.757,0,0,0,43,73.75h8a1.75,1.75,0,0,0,0-3.5H43A2.252,2.252,0,0,1,40.75,68V60A2.252,2.252,0,0,1,43,57.75Z'/><path d='M65,54.25H59A1.751,1.751,0,0,0,57.25,56V72a1.75,1.75,0,0,0,3.5,0V65.75H65a5.75,5.75,0,0,0,0-11.5Zm0,8H60.75v-4.5H65a2.25,2.25,0,0,1,0,4.5Z'/><path d='M85,70.25H81A2.252,2.252,0,0,1,78.75,68V56a1.75,1.75,0,0,0-3.5,0V68A5.757,5.757,0,0,0,81,73.75h4A5.757,5.757,0,0,0,90.75,68V56a1.75,1.75,0,0,0-3.5,0V68A2.252,2.252,0,0,1,85,70.25Z'/></g></svg>
                                <progress class='cpu' value='".$row['CPUScore']."' max='".$maxScore['CPU']."'></progress>
                            </div>
                            <div class='component-gpu'>
                                <svg height='512' viewBox='0 0 48 48' width='512' xmlns='http://www.w3.org/2000/svg'><g id='Line'><path d='m45 13h-37v-3a1 1 0 0 0 -1-1h-4a1 1 0 0 0 0 2h3v27a1 1 0 0 0 2 0v-3h15v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-3h2a1 1 0 0 0 1-1v-20a1 1 0 0 0 -1-1zm-20 22h11v2h-11zm16 2h-3v-2h3zm3-4h-36v-18h36z'/><path d='m24 28a1 1 0 0 0 1-1v-1h1a3 3 0 0 0 0-6h-2a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1zm1-6h1a1 1 0 0 1 0 2h-1z'/><path d='m18 28h2a2 2 0 0 0 2-2v-2a1 1 0 0 0 -1-1h-1a1 1 0 0 0 0 2v1h-2v-4h3a1 1 0 0 0 0-2h-3a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2z'/><path d='m33 28a3 3 0 0 0 3-3v-4a1 1 0 0 0 -2 0v4a1 1 0 0 1 -2 0v-4a1 1 0 0 0 -2 0v4a3 3 0 0 0 3 3z'/></g></svg>
                                <progress class='gpu' value='".$row['GPUScore']."' max='".$maxScore['GPU']."'></progress>
                            </div>
                            <div class='component-ram'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' width='512' height='512'><g id='Line'><path d='M45,13H38.41a4.42,4.42,0,0,0-3.12,1.29,2.37,2.37,0,0,1-1.7.71H14.41a2.43,2.43,0,0,1-1.7-.71A4.4,4.4,0,0,0,9.59,13H3a1,1,0,0,0-1,1c0,.22-.11,5.42.11,5.45L3.93,23.1,2,29.73A1,1,0,0,0,3,31v3a1,1,0,0,0,1,1H44a1,1,0,0,0,1-1V31a1,1,0,0,0,.8-.4,1,1,0,0,0,.16-.87L44.07,23.1A39.33,39.33,0,0,0,46,19V14A1,1,0,0,0,45,13ZM4,15H9.59a2.43,2.43,0,0,1,1.7.71A4.4,4.4,0,0,0,14.41,17H33.59a4.42,4.42,0,0,0,3.12-1.29,2.37,2.37,0,0,1,1.7-.71H44v3.76l-1.89,3.79a1,1,0,0,0-.07.72L43.67,29H4.33L6,23.27a1,1,0,0,0-.07-.72L4,18.76ZM5,31H33v2H5Zm38,2H35V31h8Z'/><path d='M21.68,27A1.08,1.08,0,0,0,23.05,26H25l.1.32a1,1,0,0,0,1.9-.64l-2-6a1,1,0,0,0-1.9,0l-2,6A1,1,0,0,0,21.68,27ZM24.28,24h-.56l.28-.84Z'/><path d='M29,27a1,1,0,0,0,1-1V24.24l.11.21A1,1,0,0,0,32,24.24V26a1,1,0,0,0,2,0V20a1,1,0,0,0-1.89-.45L31,21.76l-1.11-2.21A1,1,0,0,0,28,20v6A1,1,0,0,0,29,27Z'/><path d='M15,27a1,1,0,0,0,1-1V24.41l2.29,2.3a1,1,0,0,0,1.42-1.42l-1.42-1.42A2.5,2.5,0,0,0,17.5,19H15a1,1,0,0,0-1,1v6A1,1,0,0,0,15,27Zm1-6h1.5a.5.5,0,0,1,0,1H16Z'/></g></svg>
                                <progress class='ram' value='".$row['Ram']."' max='".$maxScore['RAM']."'></progress>
                            </div>
                            <div class='component-ssd'>
                                <svg height='512' viewBox='0 0 48 48' width='512' xmlns='http://www.w3.org/2000/svg'><g id='Line'><path d='m3 41h36.331c1.45 0 2.691-1.036 2.952-2.464l3.701-20.357c.12-.593-.377-1.194-.984-1.179h-5v-1c0-1.654-1.346-3-3-3h-19.382l-2.724-5.447c-.169-.339-.515-.553-.894-.553h-9c-1.654 0-3 1.346-3 3v30c0 .553.448 1 1 1zm40.802-22-3.487 19.178c-.087.476-.501.822-.984.822h-34.078l4.545-20zm-39.802-9c0-.552.449-1 1-1h8.382l2.724 5.447c.169.339.515.553.894.553h20c.551 0 1 .448 1 1v1h-29c-.467 0-.872.323-.975.778l-4.025 17.71z'/></g></svg>
                                <progress class='ssd' value='".$row['Storage']."' max='".$maxScore['Storage']."'></progress>
                            </div>
                        </div>
                    </div>
                </a>";
            }
        }

        echo "<script>
            document.body.classList.add('$category');
            document.getElementById('categoryTitle').innerHTML = '$category';
            document.getElementById('categoryDescription').innerHTML = '$description';
            content = document.getElementById('laptops');
            content.innerHTML = `$content`;
        </script>";

    } else {
        include "explore.html";

    }
    $dbConn -> close();
?>
<script>document.getElementById('explore').classList.add('active');</script>