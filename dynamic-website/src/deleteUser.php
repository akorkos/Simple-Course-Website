<?php
    $mysqli = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $query = "DELETE FROM users WHERE id=$id";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query);
    $stmt->execute();
    header("Location: ../public/users.php"); 
    exit;
?>