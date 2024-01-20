<?php
    require "../src/isAuth.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- mobile first -->    
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Εργασίες</title>

        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <!--Fonts & icons-->
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>
    
    <body>
        <nav class="sidebar">
            <a href="./introduction.php"><i class="fas fa-home"></i> Αρχική σελίδα</a>
            <a href="./announcement.php"><i class="fas fa-bullhorn"></i> Ανακοινώσεις</a>
            <a href="./communication.php"><i class="fas fa-comment-alt"></i> Επικοινωνία</a></li>
            <a href="./documents.php"><i class="fas fa-file-alt"></i> Έγγραφα μαθήματος</a></li>
            <a class="active" href="#"><i class="fas fa-pencil-ruler"></i> Εργασίες</a></li>
            <?php
                $db = require "../src/connectToDataBase.php"; 
                if($_SESSION['role'] === 'tutor')
                    echo "<a href='./users.php'><i class='fa-solid fa-user-pen'></i> Διαχείριση χρηστών</a></li>";
            ?>
            <a href="../src/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Αποσύνδεση</a></li>
        </nav>

        <main>
            <h1>Εργασίες</h1>
            <ul>
                <?php
                    $db = require "../src/connectToDataBase.php"; 
                    $sql = "SELECT id, targets, file_name, files_needed, deadline FROM homeworks;";
                    $query = $db->query($sql);

                    if ($_SESSION['role'] === 'tutor'){
                        echo '
                            <li class="list-box doc-box">
                                <h2><a href="./addHomework.php">Προσθήκη νέας εργασίας</a></h2>
                            </li>';
        
                        while ($x = mysqli_fetch_row($query)) {
                            echo '<li class="list-box homework-box">
                                <h2>
                                    Εργασία '.$x[0].'
                                    <a href="../src/deleteHomework.php?id='.$x[0].'"><i title="Delete homework" 
                                        class="fa-solid fa-trash-can"></i></a>
                                    <a href="./editHomework.php?file_name=
                                        '.str_replace(' ', '&nbsp;', $x[2]).'&targets='.$x[1].'&id='.$x[0].'
                                        &files_needed='.$x[3].'&deadline='.$x[4].'">
                                        <i class="fa-solid fa-pen-to-square" title="Edit homework"></i></a>
                                </h2>
                                <h3><span class="bold-text">Στόχοι: </span></h3>
                                <div>
                                    '.nl2br($x[1]).'
                                </div>
                                <h3 class="bold-text">Εκφώνηση:</h3>
                                <p>
                                    Κατεβάστε την εκφώνηση της εργασίας από 
                                    <a href="'.$x[2].'"> εδώ</a>.
                                </p>
                                <h3 class="bold-text">Παραδοτέα:</h3>
                                <div>
                                    '.nl2br($x[3]).'
                                </div>
                                <p>
                                    <span class="empasize-text">Ημερομηνία παράδοσης: </span>'.$x[4].'
                                </p>
                            </li>';
                        }
                    } else {
                        while ($x = mysqli_fetch_row($query)) {
                            echo '<li class="list-box homework-box">
                                <h2> Εργασία '.$x[0].' </h2>
                                <h3> <span class="bold-text">Στόχοι: </span></h3>
                                <div>
                                    '.nl2br($x[1]).'
                                </div>
                                <h3 class="bold-text">Εκφώνηση:</h3>
                                <p>
                                    Κατεβάστε την εκφώνηση της εργασίας από 
                                    <a href="'.$x[2].'"> εδώ</a>.
                                </p>
                                <h3 class="bold-text">Παραδοτέα:</h3>
                                <div>
                                    '.nl2br($x[3]).'
                                </div>
                                <p>
                                    <span class="empasize-text">Ημερομηνία παράδοσης: </span>'.$x[4].'
                                </p>
                            </li>';
                        }
                    }
                ?>
            </ul>

            <div class="top-link">
                <a href="#top">Top <i class="fa-solid fa-arrow-up"></i></a> 
            </div>
        </main>
    </body>
</html>