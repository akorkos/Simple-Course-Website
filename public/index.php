<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require "../src/connectToDataBase.php";

        $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
        $_SESSION['role'] = $user['role'];
        $_SESSION['valid'] = true;

        if ($user){
            if ($_POST["password"] === $user["password"])
                header("Location: ./introduction.php");
            else {
                header("Location: ./index.php?error=1");
            }
        } else {    
            header("Location: ./index.php?error=1");
        }
           
        exit;
    }
?>

<!DOCTYPE html>
<html lang="el">
    <head>
    <meta charset="UTF-8">
        <title>Login</title>
        <link rel="shortcut icon" type="image/png" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/index.css">
        <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        <link href="../assets/fontawesome/css/fontawesome.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/brands.css" rel="stylesheet">
        <link href="../assets/fontawesome/css/solid.css" rel="stylesheet">
    </head>

    <body>
        <main id="container-login">
            <div id="title">
                Σύνδεση στο μάθημα
            </div>
            <form method=post>
                <div class="input">
                    <div class="input-addon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input id="email" placeholder="Email" type="email" name="email" required class="validate">
                </div>
                <div class="input">
                    <div class="input-addon">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <input id="password" placeholder="Password" type="password" name="password" required class="validate">
                </div>
                <input type="submit" value="Είσοδος" />
            </form>
        </main>
    </body>
</html>