<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- mobile first -->    
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Διαχείριση χρηστών</title>
        <!--Stylesheets-->
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <!--Fonts & icons-->
        <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
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
            <a href="./homework.php"><i class="fas fa-pencil-ruler"></i> Εργασίες</a></li>
            <?php
                $db = require "../src/connectToDataBase.php"; 
                if($_SESSION['role'] === 'tutor')
                    echo "<a class='active' href='#'><i class='fa-solid fa-user-pen'></i> Διαχείριση χρηστών</a></li>";
            ?>
            <a href="../src/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Αποσύνδεση</a></li>
        </nav>

        <main>
            <form method="post">
                <h1>Χρήστες συστήματος</h1>
                <ul>
                <?php
                    $db = require "../src/connectToDataBase.php";
                    $sql = "SELECT id, name, surname, email, password, role FROM users WHERE role = 'student';";
                    $res = $db->query($sql);

                    echo '
                        <li class="list-box doc-box">
                            <h2>
                                <a href="./addUser.php">Προσθήκη νέου χρήστη</a>
                            </h2>
                        </li>';

                    while ($x = mysqli_fetch_row($res)) {
                        echo '<li class="list-box users-box">
                            <h2>
                                Χρήστης (ID): '.$x[0].'
                                <a href="../src/deleteUser.php?id='.$x[0].'"><i class="fa-solid fa-user-xmark"
                                    title="Διαγραφή χρήστη"></i></a>
                                <a href="./editUsers.php?name='.$x[1].'&surname='.$x[2].'&email='.$x[3].'
                                    &password='.$x[4].'&id='.$x[0].'"><i class="fa-solid fa-user-pen" 
                                    title="Επεξεργασία χρήστη"></i></a>
                            </h2>
                            <h3><span class="bold-text">Στοιχεία: </span></h3>
                            <p> 
                                Όνομα: '.$x[1].'
                            </p>
                            <p> 
                                Επώνυμο: '.$x[2].'
                            </p>
                            <p> 
                                Email: '.$x[3].'
                            </p>
                            <p> 
                                Κωδικός: '.$x[4].'
                            </p>
                            <p> 
                                Ρόλος: '.$x[5].'
                            </p>
                        </li>';   
                    }
                ?>
                </ul>
            </form>
            <div class="top-link">
                <a href="#top">Top <i class="fa-solid fa-arrow-up"></i></a> 
            </div>
        </main>
    </body>
</html>