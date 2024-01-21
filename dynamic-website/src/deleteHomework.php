<?php
    $mysqli = require "../src/connectToDataBase.php";

    $id = $_GET['id']; 

    $sql = "DELETE FROM homeworks WHERE id=$id";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    header("location: ../public/homework.php"); 
    exit;

?>
