
<?php
session_start();
require "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || strlen($username) > 100 ||
        strlen($password) < 8) {
        $message = "Enter a username (max 100 characters) and password (at least 8 characters).";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (username, password) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $username, $hash);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: login.php");
            exit;
        } else {
            $message = "Registration failed. Username may already exist.";
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Create Account</h1>
    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" maxlength="100" required>
        <br><br>

        <label>Password (minimum 8 characters)</label><br>
        <input type="password" name="password" minlength="8" required>
        <br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already registered? <a href="login.php">Login</a></p>
</body>
</html>
