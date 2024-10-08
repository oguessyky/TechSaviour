<?php
    include "../headers/navBar.php";
    include "contactUs.html";
?>
<script>
    document.getElementById('contactUs').classList.add('active')
    <?php
    if ($isSet) {
        echo "document.querySelector('.list-email-unlogin').style.display = 'none';";
        echo "document.querySelector('.list-email-login').style.display = 'block';";
    }
    ?>
</script>
