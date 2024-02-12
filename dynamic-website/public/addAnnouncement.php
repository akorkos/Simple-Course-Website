<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";
        
        $query = "INSERT INTO announcements (date, subject, text) 
            VALUES (?, ?, ?)";
    
        $stmt = $db->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param(
            "sss",
            date("Y/m/d"), 
            $_POST["subject"], 
            $_POST["text"]
        );
        $stmt->execute();
        header("Location: ../public/announcement.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Προσθήκη ανακοίνωσης</title>
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
        <main class="add-page">
            <form method="post">
                <h2>Προσθήκη ανακοίνωσης</h2>
                <p>
                    Θέμα: <br>
                    <input id='subject' type='text' placeholder="Θέμα"
                        name='subject' required><br>
                </p>
                <p>                  
                    Κείμενο: <br>  
                    <textarea id="text" name="text" rows="5" cols="50"
                        placeholder="Πληροφορίες" required></textarea><br>
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