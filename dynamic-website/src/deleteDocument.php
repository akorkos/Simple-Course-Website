<?php
    $db = require "../src/connectToDataBase.php";
    
    $id = $_GET['id']; 

    $query = "DELETE FROM documents WHERE id=$id";
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->execute();
    header("Location: ../public/documents.php"); 
    exit;
?>