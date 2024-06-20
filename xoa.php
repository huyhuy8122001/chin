<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['pass'])) {
    header("location: login.php");
    exit;
}

$id = $_GET['id'];

require 'db/connect.php';

$delete_sql = "DELETE FROM qualitycompany WHERE id = :id";
$stmt = $conn->prepare($delete_sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
} else {
    echo "Error deleting record: " . $stmt->errorInfo()[2];
}
?>