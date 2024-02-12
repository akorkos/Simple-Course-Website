<?php
    $db = require "../src/connectToDataBase.php";
    
    $id = $_GET['id']; 

    $sql = "DELETE FROM documents WHERE id=$id";
    $stmt = $db->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    header("location: ../public/documents.php"); 
    exit;
?>