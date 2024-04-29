<?php
require_once("config.php");
require_once("functions.php");

if (isset($_POST["Login"])) {
    $login_email = $_POST["email"];
    $login_password = $_POST["psswd"];

    if (strlen($login_email) == 0 || strlen($login_password) == 0) {
        $_SESSION["login_error"] = "email and Password cannot be empty.";
    }
    else {
        $db = get_mysqli_connection();
        $query = $db->prepare("SELECT password FROM User WHERE email = ?");
        $query->bind_param("s",$login_email);
        $query->execute();
        $result = $query->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
        if (count($results) > 0) {
            $hash = $results[0]["password"];

            if (password_verify($login_password,$hash)) {
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

