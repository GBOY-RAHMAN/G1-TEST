<?php
$servername = "localhost"; // Database server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "phpproject_01"; // Database name

// Enable mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Set charset to avoid issues with special characters
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}
?>
