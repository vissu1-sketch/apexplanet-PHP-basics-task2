
<?php
require "db.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Invalid post ID.");
}

$stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$post) {
    exit("Post not found.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $content = trim($_POST["content"] ?? "");

    if ($title !== "" && $content !== "") {
        $stmt = $conn->prepare(
            "UPDATE posts SET title = ?, content = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $title, $content, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: index.php");
            exit;
        }

        $message = "Unable to update post.";
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
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <p><?= htmlspecialchars($message) ?></p>

    <form method="POST">
        <label>Title</label><br>
        <input type="text" name="title" maxlength="255"
               value="<?= htmlspecialchars($post["title"]) ?>" required>
        <br><br>

        <label>Content</label><br>
        <textarea name="content" rows="6" required><?= htmlspecialchars($post["content"]) ?></textarea>
        <br><br>

        <button type="submit">Update Post</button>
    </form>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
