
<?php
$host = "localhost";
$port = 3307;
$dbname = "blog";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
