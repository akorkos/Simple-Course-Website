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

        try{
            $stmt = $mysqli->prepare("UPDATE users SET name = ?, surname = ?, email = ?, password=?, role=? WHERE id = ?");
            $stmt->bind_param("sssssi", $name, $surname, $email, $password, $role, $_GET['id']);

            $stmt->execute();
        }catch(Exception $e){
            header("Location: ./users.php");
            exit;
        };
        
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
        <!--Stylesheets-->
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <!--Fonts & icons-->
        <link rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <nav class="sidebar">
            <a href="./introduction.php"><i class="fas fa-home"></i> Αρχική σελίδα</a>
            <a href="./announcement.php"><i class="fas fa-bullhorn"></i> Ανακοινώσεις</a>
            <a href="./communication.php"><i class="fas fa-comment-alt"></i> Επικοινωνία</a></li>
            <a href="./documents.php"><i class="fas fa-file-alt"></i> Έγγραφα μαθήματος</a></li>
            <a href="./homework.php"><i class="fas fa-pencil-ruler"></i> Εργασίες</a></li>
            <?php
                $db = require "../src/connectToDataBase.php"; 
                if($_SESSION['role'] === 'tutor')
                    echo "<a class='active' href='#'><i class='fa-solid fa-user-pen'></i> Διαχείριση χρηστών</a></li>";
            ?>
            <a href="../src/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Αποσύνδεση</a></li>
        </nav>

        <main class="edit-page">
            <form method="post">
                <h1>Επεξεργασία χρήστη</h1>
                <?php
                    $db = require "../src/connectToDataBase.php";
                    $sql = "SELECT name, surname, email, password, role FROM users WHERE id = ".$_GET['id'].";";
                    $res = $db->query($sql);
                    $x = mysqli_fetch_row($res);

                    echo '
                        <h3>
                            <span class="bold-text">Στοιχεία: </span>
                        </h3>
                        <p> 
                            Όνομα:
                            <input id="name" type="name" name="name" value='.$x[0].' required>
                        </p>
                        <p> 
                            Επώνυμο:
                            <input id="surname" type="surname" name="surname" value='.$x[1].' required>
                        </p>
                        <p> 
                            Email:
                            <input id="email" type="email" name="email" value='.$x[2].' required>
                        </p>
                        <p> 
                            Κωδικός:
                            <input id="pass" type="password" name="pass" value='.$x[3].' required>
                        </p>
                        <p> 
                            Ρόλος:
                            <select name="role" id="role">
                                <option value="student">Φοιτητής</option>
                                <option value="tutor">Διδάσκων</option>
                            </select>
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