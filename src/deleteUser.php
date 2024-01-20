<?php
    $mysqli = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $sql = "DELETE FROM users WHERE id=$id";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    header("location: ../public/users.php"); 
    exit;
?>