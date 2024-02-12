<?php
    require "../src/isAuth.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Έγγραφα μαθήματος</title>

        <link rel="stylesheet" type="text/css" media="screen" 
            href="../css/style.css" />
        <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' 
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <div class="sidebar">
            <a href="./introduction.php">
                <i class="fas fa-home"></i> Αρχική σελίδα
            </a>
            <a href="./announcement.php">
                <i class="fas fa-bullhorn"></i> Ανακοινώσεις
            </a>
            <a href="./communication.php">
                <i class="fas fa-comment-alt"></i> Επικοινωνία
            </a>
            <a class="active" href="#">
                <i class="fas fa-file-alt"></i> Έγγραφα μαθήματος
            </a>
            <a href="./homework.php">
                <i class="fas fa-pencil-ruler"></i> Εργασίες
            </a>
            <?php
                $db = require "../src/connectToDataBase.php"; 
                if($_SESSION['role'] === 'tutor'){
                    echo "
                        <a href='./users.php'>
                            <i class='fa-solid fa-user-pen'></i>
                            Διαχείριση χρηστών
                        </a>
                    ";
                }
            ?>
            <a href="../src/logout.php">
                <i class="fa-solid fa-right-from-bracket"></i> Αποσύνδεση
            </a>
        </div>

        <main>
            <h1>Έγγραφα μαθήματος</h1>
            <ul>
                <?php 
                    $db = require "../src/connectToDataBase.php"; 
                    $sql = "SELECT id, title, description, file_name
                            FROM documents;";
                    $query = $db->query($sql);
                    
                    if($_SESSION['role'] === 'tutor'){
                        echo '
                            <li class="list-box doc-box">
                                <h2>
                                    <a href="./addDocument.php">
                                        Προσθήκη νέου εγγράφου
                                    </a>
                                </h2>
                            </li>
                        ';
                
                        while ($row = mysqli_fetch_row($query)){
                            echo '
                                <li class="list-box doc-box">
                                
                                <h2>
                                    '.$row[1].'
                                    <a href="../src/deleteDocument.php?id='.$row[0].'"><i title="Delete document" 
                                    class="fa-solid fa-trash-can"></i></a>
                                    <a href="./editDocument.php?subject=
                                        '.str_replace(' ', '&nbsp;', $row[2]).'&text='.$row[3].'&id='.$row[0].'"> 
                                        <i class="fa-solid fa-pen-to-square" title="Edit document"></i>
                                    </a>    
                                </h2>
                                <p>
                                    <span class="bold-text">
                                        Περιγραφή: 
                                    </span> '.$row[2].'
                                </p>
                                <p>
                                    <a href="'.$row[3].'">Download</a>
                                </p>
                            </li>';
                        }
                    } else {
                        while ($row = mysqli_fetch_row($query)){
                            echo '
                                <li class="list-box doc-box">
                                    <h2>
                                        '.$row[1].' 
                                    </h2>
                                    <p>
                                        <span class="bold-text">
                                            Περιγραφή: 
                                        </span> '.$row[2].'
                                    </p>
                                    <p>
                                        <a href="'.$row[3].'">Download</a>
                                    </p>
                                </li>
                            ';
                        }
                    }
                ?>
            </ul>

            <div class="top-link">
                <a href="#top">
                    Top <i class="fa-solid fa-arrow-up"></i>
                </a> 
            </div>
        </main>
    </body>
</html>