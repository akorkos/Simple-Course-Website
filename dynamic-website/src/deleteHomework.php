<?php
    $mysqli = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $query = "DELETE FROM homeworks WHERE id=$id";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query);
    $stmt->execute();
    header("Location: ../public/homework.php"); 
    exit;

?>
