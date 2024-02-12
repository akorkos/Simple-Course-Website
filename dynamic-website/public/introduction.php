<?php
    require "../src/isAuth.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Αρχική Σελίδα</title>

        <link rel="stylesheet" type="text/css" media="screen" 
            href="../css/style.css" />
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter'
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <div class="sidebar">
            <a class="active" href="#">
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
            <div class="main-text">
                <h1>Αρχική σελίδα</h1>
                <p>
                    Καλώς ήρθατε στην ιστοσελίδα του μαθήματος "Προγραμματισμός 
                    Υπολογιστών" του Τμήματος Πληροφορικής του Αριστοτέλειου
                    Πανεπιστημίου Θεσσαλονίκης.
                </p>
                <p>
                    Στην ιστοσελίδα αυτή θα βρείτε όλες τις ανακοινώσεις του
                    μαθήματος, τα έγγραφα του μαθήματος, τις εργασίες που έχουν 
                    ανατεθεί και τα αποτελέσματα των εργασιών.
                </p>
                <p>
                    Επίσης, μπορείτε να επικοινωνήσετε με τον διδάσκοντα του 
                    μαθήματος μέσω της ιστοσελίδας.
                </p>
            </div>

            <div class="image">
                <img src="../images/auth_logo.png" 
                    alt="Aristotle University of Thessaloniki logo"/>
            </div>
        </main>
    </body>
</html>