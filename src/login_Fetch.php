<?php
//  to display error message on the page if the is any
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ecsho "Form submitted successfully.<br>";

    $fname = htmlspecialchars($_POST['yname']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);

    echo "These are the information:<br>";
    echo "Name: " . $fname . "<br>";
    echo "Email: " . $email . "<br>";
 echo "Password: " . $pass . "<br>";
} else {
    echo "Form not submitted.";
}
?>
