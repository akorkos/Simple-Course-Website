<?php
    $servername = "webpagesdb.it.auth.gr:3306";
    $username = "alexkork";
    $password = "VdSzBz2006";
    $dbname = "student3870partB";
    
    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db -> connect_error) 
        die("Connection failed: " . $db->connect_error);
    return $db; 
?>
