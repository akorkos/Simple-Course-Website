<?php
    require "../src/isAuth.php";
    require "../src/isTutor.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require "../src/connectToDataBase.php";
		
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $role = $_POST["role"];
        $id = $_GET['id'];

        $stmt = $mysqli->prepare(
            "UPDATE users SET name = ?, surname = ?, email = ?, password=?, 
            role=? WHERE id = ?"
        );

        $stmt->bind_param(
            "sssssi",
            $name, 
            $surname, 
            $email, 
            $password, 
            $role, 
            $id
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
        <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' 
            rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <main class="edit-page">
            <form method="post">
                <h1>Επεξεργασία χρήστη</h1>
                <?php
                    $db = require "../src/connectToDataBase.php";
                    $query = "SELECT name, surname, email, password, role FROM 
                        users WHERE id = ".$_GET['id'].";";
                    $result = $db->query($query);
                    $row = mysqli_fetch_row($result);

                    echo'
                        <h3>
                            <span class="bold-text">Στοιχεία: </span>
                        </h3>
                        <p> 
                            Όνομα:
                            <input id="name" type="name" name="name" 
                                value='.$row[0].' required>
                        </p>
                        <p> 
                            Επώνυμο:
                            <input id="surname" type="surname" name="surname" 
                                value='.$row[1].' required>
                        </p>
                        <p> 
                            Email:
                            <input id="email" type="email" name="email" 
                                value='.$row[2].' required>
                        </p>
                        <p> 
                            Κωδικός:
                            <input id="pass" type="password" name="pass" 
                                value='.$row[3].' required>
                        </p>
                        <p> 
                            Ρόλος:
                            <select name="role" id="role">
                                <option value="student">Φοιτητής</option>
                                <option value="tutor">Διδάσκων</option>
                            </select>
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