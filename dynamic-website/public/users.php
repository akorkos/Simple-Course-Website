<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Διαχείριση χρηστών</title>

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
                        <a class='active' href='#'>
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
            <form method="post">
                <h1>Χρήστες συστήματος</h1>
                <ul>
                <?php
                    $db = require "../src/connectToDataBase.php";
                    $sql = "SELECT id, name, surname, email, password, role 
                        FROM users WHERE role = 'student';";
                    $result = $db->query($sql);

                    echo '
                        <li class="list-box doc-box">
                            <h2>
                                <a href="./addUser.php">Προσθήκη νέου χρήστη</a>
                            </h2>
                        </li>
                    ';

                    while ($row = mysqli_fetch_row($result)) {
                        echo '
                            <li class="list-box users-box">
                                <h2>
                                    Χρήστης (ID): '.$row[0].'
                                    <a href="../src/deleteUser.php?id='.$row[0].'"><i class="fa-solid fa-user-xmark"
                                        title="Διαγραφή χρήστη"></i></a>
                                    <a href="./editUsers.php?name='.$row[1].'&surname='.$row[2].'&email='.$row[3].'
                                        &password='.$row[4].'&id='.$row[0].'"><i class="fa-solid fa-user-pen" 
                                        title="Επεξεργασία χρήστη"></i></a>
                                </h2>
                                <h3>
                                    <span class="bold-text">Στοιχεία: </span>
                                </h3>
                                <p> 
                                    Όνομα: '.$row[1].'
                                </p>
                                <p> 
                                    Επώνυμο: '.$row[2].'
                                </p>
                                <p> 
                                    Email: '.$row[3].'
                                </p>
                                <p> 
                                    Κωδικός: '.$row[4].'
                                </p>
                                <p> 
                                    Ρόλος: '.$row[5].'
                                </p>
                            </li>
                        ';   
                    }
                ?>
                </ul>
            </form>
            <div class="top-link">
                <a href="#top">
                    Top <i class="fa-solid fa-arrow-up"></i>
                </a> 
            </div>
        </main>
    </body>
</html>