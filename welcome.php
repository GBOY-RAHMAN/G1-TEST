<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="./output.css" rel="stylesheet" />
</head>
<body>
    <section class="w-max m-auto">
        <h1 class="text-lg font-medium">Welcome, <?php echo htmlspecialchars($_SESSION["useremail"]); ?>!</h1>
        <a href="logout.php" class="text-blue-700 hover:cursor-pointer">Logout</a>
    </section>
</body>
</html>
