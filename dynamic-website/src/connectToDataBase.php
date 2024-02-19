<?php
    $servername = "localhost";
    $username = "alexkork";
    $password = "";
    $dbname = "student3870partB";
    
    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db->connect_error) 
        die("Connection failed: " . $db->connect_error);
    return $db; 
?>
