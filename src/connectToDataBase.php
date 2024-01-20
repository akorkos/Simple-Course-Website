<?php
    $servername = "localhost";
    $username = "root";
    $password = "a17034422!";
    $dbname = "course_site";
    
    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db -> connect_error) 
        die("Connection failed: " . $db->connect_error);
    return $db; 
?>
