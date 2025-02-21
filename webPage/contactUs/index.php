<?php
    include "../headers/navBar.php";
    include "contactUs.html";
?>
<script>
    document.getElementById('contactUs').classList.add('active')
    <?php
    if ($isSet) {
        echo "document.querySelector('.list-email-unlogin').style.display = 'none';
        document.querySelector('.list-email-login').style.display = 'block';";
    }
    ?>
</script>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require "../headers/dbConn.php";
        $inquiry = $_POST['inquiry'];
        if ($dbConn -> query("INSERT INTO Feedback(Username,Inquiry) VALUES ('$username',".json_encode($inquiry).")")) {
            echo "<script>alert('Your message has been submitted successfully!');</script>";
        }
        $dbConn -> close();
    }
?>