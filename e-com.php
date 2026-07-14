<?php
$conn = new mysqli("localhost", "root", "", "trendingshoes");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>