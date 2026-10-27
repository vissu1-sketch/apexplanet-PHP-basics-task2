
<?php
require "db.php";

$result = $conn->query(
    "SELECT id, title, content, created_at FROM posts ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
</head>
<body>
    <h1>My Blog</h1>
    <p><a href="logout.php">Logout</a></p>

    <p><a href="create.php">+ Create New Post</a></p>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($post = $result->fetch_assoc()): ?>
            <article>
                <h2><?= htmlspecialchars($post["title"]) ?></h2>
                <p><?= nl2br(htmlspecialchars($post["content"])) ?></p>
                <small>
                    <?= htmlspecialchars($post["created_at"] ?? "") ?>

                    <p>
                        <a href="edit.php?id=<?= (int)$post['id'] ?>">Edit</a>
                    </p>

                    <form action="delete.php" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>


                </small>
                <hr>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts yet. Create your first post!</p>
    <?php endif; ?>
</body>
</html>
