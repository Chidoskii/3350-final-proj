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
//if(isset($_POST['Register'])) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Sends as a server request instead of isset
    $register_user = $_POST['register_user'];
    $register_email = $_POST['register_email'];
    $register_password = $_POST['register_password'];

    if (strlen($register_user) == 0 || strlen($register_email) == 0 || strlen($register_password) == 0) {
        http_response_code(400);
        $_SESSION["register_error"] = "Missing info in required fields.";
        echo "Empty request, something went wrong while sending";
        die();
    }
    else {
        inputFilter($register_user, $register_email, $register_password); // Sanitizes the string
        if(findUser($register_user) === $register_user) {
            //error
            http_response_code(400);
            $_SESSION["register_error"] = "$register_user has been taken already";
            echo "User already exists";
            die();
        }
        $check = findEmail($register_email);
        if ($check === $register_email) {
            //error
            http_response_code(400);
            $_SESSION["register_error"] = "This email has already been registered";
            echo "Email already exists";
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
            echo "User successfuly added";
        }
        else {
            http_response_code(405);
            echo "Failed to add";
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