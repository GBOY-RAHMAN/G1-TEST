<?php

function emptyInputSignup($fname, $email, $pass) {
    return empty($fname) || empty($email) || empty($pass);
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function invalidPass($pass) {
    return strlen($pass) < 8;
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../src/login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $email, $pass) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../src/login.php?error=stmtfailed");
        exit();
    }

    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

    mysqli_stmt_bind_param($stmt, "sss", $fname, $email, $hashedPass);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    header("Location: ../src/login.php?signup=success");
    exit();
}

function emptyInputLogin($email, $pass) {
    return empty($email) || empty($pass);
}

function loginUser($conn, $email, $pass) {
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false) {
        header("location: ../src/login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $emailExists["usersPwd"];
    $checkPwd = password_verify($pass, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../src/login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $emailExists["id"];
        $_SESSION["useremail"] = $emailExists["usersEmail"];
        header("location: ../src/index.php");
        exit();
    }
}
?>
