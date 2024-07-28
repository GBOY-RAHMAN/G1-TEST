<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    try {
        // Debugging lines
        error_log("Email: " . $email);
        error_log("Password: " . $pass);
        
        if (emptyInputLogin($email, $pass)) {
            header("location: ../src/login.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email)) {
            header("location: ../src/login.php?error=invalidemail");
            exit();
        }

        loginUser($conn, $email, $pass);
    } catch (Exception $e) {
        header("location: ../src/login.php?error=stmtfailed&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("location: ../src/login.php");
    exit();
}
?>
