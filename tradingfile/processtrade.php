<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../signup_system/dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'add') {
        // Adding a trade
        $trade_id = htmlspecialchars($_POST['trade_id']);
        $coinname = htmlspecialchars($_POST['coinname']);
        $percentage = htmlspecialchars($_POST['percentage']);
        $amount = htmlspecialchars($_POST['amount']);
        $date = htmlspecialchars($_POST['trade_date']);
        $country = htmlspecialchars($_POST['country']);

        try {
            $sql = "INSERT INTO trades (trade_id, coinname, percentage, amount, trade_date, country) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssdss", $trade_id, $coinname, $percentage, $amount, $date, $country);
            $stmt->execute();

            header("Location: ../src/trading.php?success=trade_added");
            exit();
        } catch (mysqli_sql_exception $e) {
            header("Location: ../src/trading.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($action == 'delete') {
        // Deleting a trade
        $trade_id = $_POST['trade_id'];

        try {
            $sql = "DELETE FROM trades WHERE trade_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $trade_id);
            $stmt->execute();

            header("Location: ../src/trading.php?success=trade_deleted");
            exit();
        } catch (mysqli_sql_exception $e) {
            header("Location: ../src/trading.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    } elseif ($action == 'update') {
        // Updating a trade
        $trade_id = htmlspecialchars($_POST['trade_id']);
        $coinname = htmlspecialchars($_POST['coinname']);
        $percentage = htmlspecialchars($_POST['percentage']);
        $amount = htmlspecialchars($_POST['amount']);
        $date = htmlspecialchars($_POST['trade_date']);
        $country = htmlspecialchars($_POST['country']);

        try {
            $sql = "UPDATE trades SET coinname = ?, percentage = ?, amount = ?, trade_date = ?, country = ? WHERE trade_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsss", $coinname, $percentage, $amount, $date, $country, $trade_id);
            $stmt->execute();

            header("Location: ../src/trading.php?success=trade_updated");
            exit();
        } catch (mysqli_sql_exception $e) {
            header("Location: ../src/trading.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}

?>
