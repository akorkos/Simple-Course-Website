<?php
    require "../src/isAuth.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Ανακοινώσεις</title>

        <link rel="stylesheet" type="text/css" media="screen" 
            href="../css/style.css"/>
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' 
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">

    <body>
        <div class="sidebar">
            <a href="./introduction.php">
                <i class="fas fa-home"></i> Αρχική σελίδα
            </a>
            <a class="active" href="#">
                <i class="fas fa-bullhorn"></i> Ανακοινώσεις
            </a>
            <a href="./communication.php">
                <i class="fas fa-comment-alt"></i> Επικοινωνία
            </a>
            <a href="./documents.php">
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
            <?php
                $db = require "../src/connectToDataBase.php"; 
                $sql = "SELECT id, date, subject, text FROM announcements;";
                $result = $db->query($sql);

                echo "
                    <h1>Ανακοινώσεις</h1>
                    <ul>
                ";

                if($_SESSION['role'] === 'tutor') {
                    echo "
                        <li class='list-box'>
                            <h2>
                                <a href='./addAnnouncement.php'>
                                    Προσθήκη νέας ανακοίνωσης
                                </a>
                            </h2>
                        </li>"; 

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                            <li class="list-box">
                                <h2>
                                    Ανακοίνωση '.$row[0].'
                                    <a href="../src/deleteAnnouncement.php?id='.$row[0].'">
                                        <i title="Διαγραφή ανακοίνωσης"
                                            class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <a href="./editAnnouncement.php?subject=
                                        '.str_replace(' ', '&nbsp;', $row[2]).'&text='.$row[3].'&id='.$row[0].'"> 
                                        <i class="fa-solid fa-pen-to-square" title="Επεξεργασία ανακοίνωσης"></i>
                                    </a>
                                </h2>
                                <p>
                                    <span class="bold-text">Ημερομηνία: </span>
                                    '.$row[1].'
                                </p>
                                <p class="subject">
                                    <span class="bold-text">Θέμα: </span>
                                    '.$row[2].'
                                </p>
                                <p>'.$row[3].'</p>
                            </li>'; 
                    }
                }
                while ($row = mysqli_fetch_row($result)) {
                    echo '
                        <li class="list-box">
                            <h2>Ανακοίνωση '.$row[0].'</h2>
                            <p>
                                <span class="bold-text">Ημερομηνία: </span>
                                '.$row[1].'
                            </p>
                            <p class="subject">
                                <span class="bold-text">Θέμα: </span>
                                '.$row[2].'
                            </p>
                            <p>'.$row[3].'</p>
                        </li>'; 
                }
                echo "</ul>";
            ?>

            <div class="top-link">
                <a href="#top">Top 
                    <i class="fa-solid fa-arrow-up"></i>
                </a> 
            </div>
        </main>
    </body>
</html>