<?php
$host = "db";
$username = "php_docker";
$password = "password";
$dbname = "qualitycompany";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo " ";
} catch(PDOException $e) {
    echo " " . $e->getMessage();
}
?>