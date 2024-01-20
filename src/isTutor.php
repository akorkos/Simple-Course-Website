<?php
    if($_SESSION["role"] != "tutor") {
        header("Location: ./index.php");
        die();
    }
?>