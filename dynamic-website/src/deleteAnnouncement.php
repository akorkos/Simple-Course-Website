<?php
    $db = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $sql = "DELETE FROM announcements WHERE id = $id";
    $stmt = $db->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    header("location: ../public/announcement.php"); 
    exit;
?>