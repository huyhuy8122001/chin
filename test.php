<?php 
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['pass'])){
        header("location: login.php");
        exit();
    }
?>

<?php

require 'db/connect.php';

$admin_sql = "SELECT * FROM `admin`";
$stmt = $conn->query($admin_sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['btn-login'])){
    $name = $_POST['Name'];
    $pass = $_POST['Pass'];
    if (!empty($name)&& !empty($pass)){
        if($name == $row['name'] && $pass == $row['pass']){
            header("location:admin.php");
            exit();
        }else{
            echo "sai tài khoản và mật khẩu";
        }
    }    
}
?>