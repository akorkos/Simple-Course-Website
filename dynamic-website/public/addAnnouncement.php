<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";
        
        $sql = "INSERT INTO announcements (date, subject, text) VALUES (?, ?, ?)";

        //TODO: change stmt name!
        $stmt = $db->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("sss", date("Y/m/d"), $_POST["subject"], $_POST["mainText"]);
        $stmt->execute();
        header("Location: ../public/announcement.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- mobile first -->    
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Προσθήκη ανακοίνωσης</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <!--Fonts & icons-->
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">

    </head>

    <body>
        <main class="add-page">
            <form method="post">
                <h2>Προσθήκη ανακοίνωσης</h2>
                <p>
                    <label for="subject">Θέμα: </label><br>
                    <input id='subject' type='text' placeholder="Θέμα"  name='subject' required><br>
                </p>
                <p>                  
                    <label for="mainText">Κείμενο: </label><br>  
                    <textarea id="mainText" name="mainText" rows="5" cols="50" placeholder="Πληροφορίες" required></textarea><br>
                </p>   
                    <button>Προσθήκη</button>
            </form>
            <div class="top-link">
                Back to <a href="./introduction.php"><i class="fa-solid fa-house"></i></a> 
            </div>
        </main>
    </body>
</html>