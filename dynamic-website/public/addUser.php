<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require "../src/connectToDataBase.php";

        $query = "INSERT INTO users (name, surname, email, password, role)
            VALUES (?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param(
            "sssss",
            $_POST["name"],
            $_POST["surname"],
            $_POST["email"],
            $_POST["password"],
            $_POST["role"]
        );
                      
        $stmt->execute();
        
        header("Location: ./users.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Διαχείριση χρηστών</title>
        
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
                <h2>Προσθήκη νέου χρήστη</h2>
                <h3><span class="bold-text">Στοιχεία: </span></h3>
                <p> 
                    Όνομα:
                    <input id="name" type="name" name="name" required>
                </p>
                <p> 
                    Επώνυμο:
                    <input id="surname" type="surname" name="surname" required>
                </p>
                <p> 
                    Email:
                    <input id="email" type="email" name="email" required>
                </p>
                <p> 
                    Κωδικός:
                    <input id="password" type="password" name="password" 
                        required>
                </p>
                <p> 
                    Ρόλος:
                    <select id="role" name="role">
                        <option value="student">Φοιτητής</option>
                        <option value="tutor">Διδάσκων</option>
                    </select>
                </p>
                    <button>Προσθήκη</button>
                </p>
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