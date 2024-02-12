<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";
        
        $title = $_POST["title"];
        $description = $_POST["description"];
        $fileName = $_POST["file-name"];

        $stmt = $db->prepare(
            "UPDATE documents SET title = ?, description = ?, file_name = ? 
            WHERE id = ?"
        );

        $stmt->bind_param(
            "sssi", 
            $title, 
            $description, 
            $fileName, 
            $_GET['id']
        );
        
        $stmt->execute();

        $stmt->execute();
        header("Location: ./documents.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Επεξεργασία εγγράφου</title>
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
        <main class="edit-page">
            <form method="post">
                <h2>Επεξεργασία εγγράφου</h2>
                <?php
                    
                    $db = require "../src/connectToDataBase.php";
                    $sql = "SELECT title, description, file_name FROM documents 
                            WHERE id = ".$_GET['id'].";";
                    $res = $db->query($sql);
                    $x = mysqli_fetch_row($res);

                    echo'
                        <p>
                            Τίτλος:
                            <input id="title" type="text" name="title" 
                            style="width: 210px;" required value=\''.$x[0].'\'><br>
                        </p>  
                        <p>
                            Κείμενο:<br>
                            <textarea id="description" name="description" 
                                rows="4" cols="50" required>'.$x[1].'
                            </textarea><br>
                        </p>
                        <p>
                            Νέα θέση αρχείου εκφώνησης:
                            <input style="width: 210px;" id="file-name" 
                                type="text" value='.$x[2].' 
                                placeholder="files/<όνομα_αρχείου>.<επέκταση>" 
                                name="file-name" required><br>
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