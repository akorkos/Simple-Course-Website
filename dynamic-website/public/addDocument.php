<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $db = require "../src/connectToDataBase.php";

        $query = "INSERT INTO documents (title, description, file_name) 
            VALUES (?, ?, ?)";

        $stmt = $db->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param(
            "sss",
            $_POST["title"],
            $_POST["description"],
            $_POST["file-name"]
        );
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

        <title>Προσθήκη εγγράφου</title>
        
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
        <main class="add-page">
            <form method="post">
                <h2>Προσθήκη εγγράφου</h2>
                <p> 
                    Τίτλος:
                    <input id='title' type='text' name='title' 
                        placeholder="Τίτλος" required>    
                </p>           
                <p> 
                    Περιγραφή: <br>
                    <textarea id="description" name="description" rows="5" 
                        cols="50" placeholder="Κείμενο" required>
                    </textarea>
                </p>
                <p>     
                    Θέση αρχείου εκφώνησης:
                    <input style="width: 210px;" id='file-name' type='text' 
                        name='file-name' placeholder="../files/<όνομα_αρχείου>.<επέκταση>" 
                        required>
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