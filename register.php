<?php

session_start();

require 'db/connect.php';

// Kiểm tra xem biến $_POST['username'] có tồn tại không
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Chuẩn bị câu truy vấn SQL
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($sql);

        // Gán giá trị vào câu truy vấn
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            // Đăng ký thành công
            echo "Đăng ký thành công!";

            // Chuyển hướng đến trang đăng nhập
            header("Location: login.php");
            exit();
        } else {
            echo "Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại.";
        }
    } catch (PDOException $e) {
        echo "Đã xảy ra lỗi: " . $e->getMessage();
    }
} else {
    echo "Vui lòng điền đầy đủ thông tin đăng ký.";
}

?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
      /* Định dạng CSS cho các phần tử trên trang */
      .login-container {
  width: 400px;
  padding: 30px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.form-group {
  margin-bottom: 20px;
  text-align: left;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.login-btn {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.forgot-password {
  margin-top: 20px;
}

.forgot-password a {
  color: #4CAF50;
  text-decoration: none;
}
    </style>
</head>
<body>
<div class="login-container">
        <h2>Đăng ký</h2>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="login-btn">Đăng ký</button>
        </form>
        <div class="forgot-password">
            <a href="loginu.php">Trở về trang đăng nhập</a>
        </div>
        <?php if (isset($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>
    </div>
</div>