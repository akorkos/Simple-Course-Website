<?php
    require "../src/isAuth.php";
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";
        
        $sender = $_POST["sender"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $query = "SELECT email FROM users WHERE role = 'tutor'";

        $tutors = db->query($query);

        if (mysqli_num_rows($tutors) > 0){
            while($row = mysqli_fetch_assoc($tutors)){
                $to = $row['email'];
                $headers = "From: $sender";
                mail($to, $subject, $message, $headers);
            }
            
            header("Location: ./communication.php");
            exit;
        } else {
            header("Location: ./communication.php?error=1");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Επικοινωνία</title>

        <link rel="stylesheet" type="text/css" media="screen" 
            href="../css/style.css"/>
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
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
            <a class="active" href="#">
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
            <h1>Επικοινωνία</h1>
            <ul>
                <div class="list-box contact-box">
                    <h2>Αποστολή e-mail μέσω web φόρμας.</h2>
                    <form method=post>
                        <p>
                            Αποστολέας:
                            <input type="email" name="sender" 
                                placeholder="Διεύθυνση email" required>
                        </p>
                        <p>
                            Θέμα:
                            <input type="text" name="subject" placeholder="Θέμα" 
                                required>
                        </p>
                        <p>
                            Κείμενο: <br>
                            <textarea name="message" cols="40" rows="10" 
                                placeholder="Μύνημα">
                            </textarea>
                        </p>
                        <button>Αποστολή</button>
                    </form>
                </div>

                <div class="contact-box">
                    <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
                    <p>
                        Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω
                        διεύθυνση ηλεκτρονικού ταχυδρομείου
                        <a href="mailto:tutor@csd.auth.test.gr">
                            tutor@csd.auth.test.gr
                        </a>
                    </p>
                </div>
            </ul>
        </main>
    </body>
</html>