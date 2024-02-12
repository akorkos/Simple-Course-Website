<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";
    

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require "../src/connectToDataBase.php";

        $sql = "INSERT 
                INTO homeworks (targets, file_name, files_needed, deadline) 
                VALUES (?, ?, ? ,?)";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param(
                            "ssss",
                            $_POST["targets"],
                            $_POST["file-name"],
                            $_POST["file-submissions"],
                            $_POST["date"]
                        );
        $stmt->execute();

        $sql= "SELECT MAX(id) FROM homeworks";
        $res = $mysqli->query($sql);
        $number = mysqli_fetch_array($res)[0];
        
        $subject = "Υποβλήθηκε η εργασία ".$number."";
        $mainText = "Η ".$number."η εργασία έχει ανακοινωθεί στην ιστοσελίδα 
                        <a href='./homework.php'>«Εργασίες»</a>.";
        
        $sql = "INSERT INTO announcements (date, subject, text) 
                VALUES (?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("sss",
                            date("Y/m/d"),
                            $subject,
                            $mainText
                        );
        $stmt->execute();

        header("Location: ./homework.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Προσθήκη νέας εργασίας</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' 
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <main class="add-page">
            <form method="post">
                <h2>Προσθήκη νέας εργασίας</h2>
                <p>
                    Στόχοι: <br>
                    <textarea id="targets" name="targets" rows="5" cols="50" 
                        required placeholder="<αριθμός>. <περιγραφή στόχου> ...">
                    </textarea><br>
                </p>
                <p>
                    Αρχείo εκφώνησης:
                    <input style="width: 210px;" id='file-name' type='text' 
                        name='file-name' placeholder="../files/<όνομα_αρχείου>.<επέκταση>" 
                        required>
                </p>
                <p>
                    Παραδοτέα: <br>
                    <textarea id="file-submissions" name="file-submissions" 
                        rows="5" cols="50" 
                        placeholder="<αριθμός>. <όνομα παραδοτέου> ..." required>
                    </textarea>
                </p>
                <p>
                    Ημερομηνία:
                    <input id='date' type='date' name='date' required>
                </p>
                <button>Προσθήκη</button>
            </form>
            <div class="top-link">
                Back to 
                <a href="./introduction.php">
                    <i class="fa-solid fa-house"></i>
                </a> 
            </div>
        </main>
    </body>
</html>