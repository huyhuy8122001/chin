<?php
session_start();
require 'db/connect.php';

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    header("location:index.php");
    exit();
}

if (isset($_POST['btnlogin'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user_sql = "SELECT * FROM `users` WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($user_sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location:index");
        exit();
    } else {
        $error_msg = "Sai tài khoản và mật khẩu";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/loginu.css">
    
</head>
<!-- <body>
  <div class="login-container">
    <h2>Đăng nhập</h2>
    <form>
      <div class="form-group">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="login-btn">Đăng nhập</button>
    </form>
    <div class="forgot-password">
      <a href="register.php">Bạn chưa có tài khoản? Đăng ký Tại đây </a>
    </div>
</div>

</body> -->
<body>
    <div class="Loginu">
        <div class="Form">
            <div class="Form-title">
                <h3>Welcome Back</h3>
                <h3>user!</h3>

                <?php
                if (isset($error_msg)) {
                    echo "<p>$error_msg</p>";
                }
                ?>
            </div>
            <form action="loginu.php" method="post" class="Form-content">
                <div class="item">
                    <label for="Name">Admin Account</label>
                    <input type="text" name="Name" id="Name" placeholder="Nhập tên tài khoản vào đây....">
                </div>
                <div class="item">
                    <label for="Pass">Password</label>
                    <input type="password" name="Pass" id="Pass" placeholder="Nhập mật khẩu vào đây">
                </div>
                <div class="Submit-button">
                    <button 
                        type="submit" class="login-btn" name = "btnlogin">Đăng nhập</button>
                    </button>
                </div>
                <div class="forgot-password">
                  <a href="register.php">Bạn chưa có tài khoản? Đăng ký Tại đây </a>
               </div>
            </form>
        </div>
    </div>
</body>
</html>