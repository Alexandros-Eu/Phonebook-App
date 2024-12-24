<?php

    $contactID = "";

    if(empty($_GET['id']))
    {
        ?>
        <script src="../functions.js">
            alert("Permission denied, this record does not have an ID!");
            window.location.href = phonebookURL;
        </script>
        <?php
    }
    else
    {
        $contactID = mysqli_real_escape_string($conn, $_GET['id']);
    }

?>