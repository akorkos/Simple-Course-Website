<?php
    $db = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $query = "DELETE FROM announcements WHERE id = $id";
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->execute();
    header("Location: ../public/announcement.php"); 
    exit;
?>