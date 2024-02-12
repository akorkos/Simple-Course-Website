<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require "../src/connectToDataBase.php";
        
        $targets = $_POST["targets"];
        $fileName = $_POST["file-name"];
        $fileSubmissions = $_POST["file-submissions"];
        $deadline = $_POST["date"];

        $stmt = $mysqli->prepare(
            "UPDATE homeworks SET targets = ?, file_name = ?, files_needed = ?, 
            deadline=? WHERE id = ?"
        );
        
        $stmt->bind_param(
            "ssssi", 
            $targets, 
            $fileName,
            $fileSubmissions,
            $deadline, 
            $_GET['id']
        );

        $stmt->execute();

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
        <title>Διαχείριση εργασιών</title>
        <link rel="stylesheet" type="text/css" media="screen" 
            href="../css/style.css"/>
        <link rel="shortcut icon" type="image/ico" href="./images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' 
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <main class="edit-page">
            <form method="post">
                <h2>Επεξεργασία εργασίας</h2>
                <?php
                    $db = require "../src/connectToDataBase.php";
                    $sql = "SELECT targets, file_name, files_needed, 
                            deadline FROM homeworks WHERE id = ".$_GET['id'].";";
                    $res = $db->query($sql);
                    $x = mysqli_fetch_row($res);

                    echo'
                        <p>
                            Στόχοι: <br>
                            <textarea id="targets" name="targets" rows="4"
                                cols="50" required>'.$x[0].'
                            </textarea>
                        </pr>
                        <p>
                            Νέα θέση αρχείου εκφώνησης:
                            <input id="file-name" type="text" name="file-name" 
                                style="width: 210px;" 
                                placeholder="files/<όνομα_αρχείου>.<επέκταση>" 
                                value='.$x[1].' required>
                        </p>
                        <p> 
                            Παραδοτέα: <br>
                            <textarea id="file-submissions" 
                                name="file-submissions" rows="4" cols="50" 
                                required>'.$x[2].'
                            </textarea>
                        </p>
                        <p>
                            Ημερομηνία:
                            <input id="date" type="date" name="date" 
                                value='.$x[3].' required>
                        </p>
                    ';
                ?>
                <button>Ενημέρωση</button>
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