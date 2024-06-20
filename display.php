
<?php 
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['pass'])){
        header("location: login.php");
        exit();
    }
    
?>
<?php

    require 'db/connect.php';
   // get the ID of the image from the URL
   $id = $_GET['id'];
   // connect to the database
   $pdo = new PDO('mysql:host=localhost;dbname=qualitycompany', 'root', '');
   // retrieve the image data from the database
   $stmt = $pdo->prepare("SELECT name,data FROM qualitycompany WHERE id=?");
   $stmt->bindParam(1, $id);
   $stmt->execute();
   // set the content type header
   header("Content-Type: image/jpeg");
   // output the image data
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   echo $row['image'];
?>