<?php
session_start();
require 'db/connect.php';

if (isset($_SESSION['name']) && isset($_SESSION['pass'])) {
    header("location: admin.php");
    exit();
}

if (isset($_POST['btn-login'])) {
    $name = $_POST['Name'];
    $pass = $_POST['Pass'];

    $admin_sql = "SELECT * FROM `admin` WHERE name = :name AND pass = :pass";
    $stmt = $conn->prepare($admin_sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['name'] = $name;
        $_SESSION['pass'] = $pass;
        header("location: admin.php");
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
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="Login">
        <div class="Form">
            <div class="Form-title">
                <h3>Welcome Back</h3>
                <h3>Admin!</h3>

                <?php
                if (isset($error_msg)) {
                    echo "<p>$error_msg</p>";
                }
                ?>
            </div>
            <form action="login.php" method="post" class="Form-content">
                <div class="item">
                    <label for="Name">Admin Account</label>
                    <input type="text" name="Name" id="Name" placeholder="Nhập tên tài khoản vào đây....">
                </div>
                <div class="item">
                    <label for="Pass">Password</label>
                    <input type="password" name="Pass" id="Pass" placeholder="Nhập mật khẩu vào đây">
                </div>
                <div class="Submit-button">
                    <button type="submit" class="btn btn-info" name="btn-login">
                        <p>Login</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>