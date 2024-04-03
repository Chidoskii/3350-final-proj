<?php
require_once("../php/config.php");

define('TITLE', "Login");
define('LOG_FILE', './error.log');
define('CSS', "../css/login.css");
define('DEVELOPER', true);

if(DEVELOPER) {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  ini_set("error_log", LOG_FILE);
}

if (isset($_POST["Login"])) {
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];

    if (strlen($login_email) == 0 || strlen($login_password) == 0) {
        $_SESSION["login_error"] = "email and Password cannot be empty.";
    }
    else {
        $db = get_mysqli_connection();
        $query = $db->prepare("SELECT password FROM Admins WHERE email = ?");
        $query->bind_param("s",$login_email);
        $query->execute();
        $result = $query->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);

        if (count($results) > 0) {
            $hash = $results[0]["password"];

            if ($login_password == $hash) {
                $_SESSION["logged_in"] = true;

                $emp = get_emp($login_email);

                if (count($emp) > 0){
                    $_SESSION["is_emp"] = true;
                    $_SESSION["get_emp"] = $emp;
                    $_SESSION["is_user"] = false;
                }
                else {
                    $_SESSION["is_emp"] = false;
                }

                header("Location: ../index.php");
            }
            else {
                $_SESSION["login_error"] = "Invalid username and password combination.";
            }
        }
        $query = $db->prepare("SELECT password FROM Users WHERE email = ?");
        $query->bind_param("s",$login_email);
        $query->execute();
        $result = $query->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
        if (count($results) > 0) {
            $hash = $results[0]["password"];

            if ($login_password == $hash) {
                $_SESSION["logged_in"] = true;
                $_SESSION["login_email"] = $login_email;

                $user = get_user($login_email);

                if (count($user) > 0){
                    $_SESSION["is_user"] = true;
                    $_SESSION["get_user"] = $user;
                    
                }
                else {
                    $_SESSION["is_user"] = false;
                }

                header("Location: ../index.php");
            }
            else {
                $_SESSION["login_error"] = "Invalid username and password combination.";
            }
        }
        else {
            $_SESSION["login_error"] = "Invalid username and password combination.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $PROJECT_NAME . " | " . TITLE ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href=<?= CSS ?>>
    <link rel="shortcut icon" href="" />
</head>
    <body>

    <h1>Write some code</h1>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>
