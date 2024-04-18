<?php
require_once("../php/config.php");

/*define('TITLE', "Login");
define('LOG_FILE', './error.log');
define('CSS', "../css/login.css");
define('DEVELOPER', true);

if(DEVELOPER) {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  ini_set("error_log", LOG_FILE);
}*/
if(isset($_POST['Register'])) {
    $register_user = $_POST['register_user'];
    $register_email = $_POST['register_email'];
    $register_password = $_POST['register_password'];

    if (strlen($register_user) == 0 || strlen($register_email) == 0 || strlen($register_password) == 0) {
        $_SESSION["register_error"] = "Missing info in required fields.";
        //echo "<br>Empty\n";
        die();
    }
    else {
        inputFilter($register_user, $register_email, $register_password); // Sanitizes the string
        if(findUser($register_user) === $register_user) {
            //error
            $_SESSION["register_error"] = "$register_user has been taken already";
            //echo "<br>User already Exists";
            die();
        }
        $check = findEmail($register_email);
        if ($check === $register_email) {
            //error
            $_SESSION["register_error"] = "This email has already been registered";
            //echo "<br>Email already Exists";
            die();
        }
        
        // Register user to database
        $password = password_hash($register_password, PASSWORD_DEFAULT);
        $db = get_mysqli_connection();
        $query = $db->prepare("INSERT INTO User (username, email, password) VALUES (?, ?, ?)");
        $query->bind_param('sss', $register_user, $register_email, $password);
        $query->execute();
        $check = $query->get_result();
        //Test if it sucessfully was entered
        $check = findUser($register_user);
        if ($check === $register_user) {
            //Success
            $_SESSION["user_added"] = "Welcome $register_user";
            //echo "<br>User Added";
        }
        else {
            die();
            //echo "<br>Failed to add";
        }
    }
}

//-----------santitize input----------//
function inputFilter(&$register_user, &$register_email, &$register_password) {
    $register_user = filter_var($register_user, FILTER_SANITIZE_STRING);
    $register_email = filter_var($register_email, FILTER_VALIDATE_EMAIL);
    $register_password = filter_var($register_password, FILTER_SANITIZE_STRING);
}

function findUser($register_user) {
    $db = get_mysqli_connection();
    $stmt = $db->prepare( "SELECT username FROM User WHERE username = ?");
    $stmt->bind_param('s', $register_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = $result->fetch_assoc();

    $value = $results["username"];

    return $value;
}

function findEmail($register_email) {
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT email FROM User WHERE email = ?");
    $query->bind_param("s", $register_email);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_assoc();

    $value = $results["email"];

    return $value;
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
        <!-- <form method="post">
            <label for="uname" class="form-label creds-label">Username</label><br>
            <input type="text" id="uname" name="register_user" class="form-control creds-input-field"><br>
            <label for="email" class="form-label creds-label">Email</label><br>
            <input type="text" id="email" name="register_email" class="form-control creds-input-field"><br>
            <label for="psswd" class="form-label creds-label">Password</label><br>
            <input type="text" id="psswd" name="register_password" class="form-control creds-input-field">
        <br>
         <div class="creds-btns-can">
          <input type="submit" name="Register" value="Register" class="btn btn-primary creds-form-btns creds-form-confirm"> -->
</form> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>
