<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";
        
        $subject = $_POST["subject"];
        $main = $_POST["main"];

        $stmt = $db->prepare("UPDATE announcements SET subject = ?, text = ? WHERE id = ?");
        $stmt->bind_param("ssi", $subject, $main, $_GET['id']);
        $stmt->execute();

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
        <title>Επεξεργασία ανακοίνωσης</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <!--Fonts & icons-->
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <main class="edit-page">
            <form method="post">
                <h2>Επεξεργασία ανακοίνωσης</h2>
                <?php
                    $db = require "../src/connectToDataBase.php"; 
                    $sql = "SELECT subject, text FROM announcements WHERE id = ".$_GET['id'].";";
                    $res = $db->query($sql);

                    $query = mysqli_fetch_row($res);

                    echo '
                        <p>
                            Θέμα:
                            <input id="subject" type="text" placeholder="Θέμα" value=\''.$query[0].'\' name="subject" required>
                        </p>
                        <p>
                            Κείμενο: <br>
                            <textarea id="main" name="main" rows="4" cols="50" placeholder="Πληροφορίες" required>'.$query[1].'</textarea>
                        </p>';
                ?>
                <button>Ενημέρωση</button>
            </form>
            <div class="top-link">
                Back to <a href="./introduction.php"><i class="fa-solid fa-house"></i></a> 
            </div>
        </main>
    </body>
</html>