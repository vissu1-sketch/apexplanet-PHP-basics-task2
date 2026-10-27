
<?php
require "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $content = trim($_POST["content"] ?? "");

    if ($title !== "" && $content !== "") {
        $stmt = $conn->prepare(
            "INSERT INTO posts (title, content) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $message = "Unable to create post.";
        }

        $stmt->close();
    } else {
        $message = "Please fill in both fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>

    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" maxlength="255" required>
        <br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="6" required></textarea>
        <br><br>

        <button type="submit">Create Post</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
