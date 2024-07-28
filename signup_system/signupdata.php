// signupdata.php
<?php
error_log("Debug message");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["submit"])) {
    $fname = htmlspecialchars($_POST['yname']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    try {
        if (emptyInputSignup($fname, $email, $pass) !== false) {
            header("location: ../src/signup.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email) !== false) {
            header("location: ../src/signup.php?error=invalidemail");
            exit();
        }

        if (invalidPass($pass) !== false) {
            header("location: ../src/signup.php?error=invalidpassword");
            exit();
        }

        if (emailExists($conn, $email) !== false) {
            header("location: ../src/signup.php?error=emailtaken");
            exit();
        }

        createUser($conn, $fname, $email, $pass);
    } catch (Exception $e) {
        header("location: ../src/signup.php?error=stmtfailed&message=" . $e->getMessage());
        exit();
    }
} else {
    header("location: ../src/signup.php");
    exit();
}
?>
