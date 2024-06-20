<?php
function getTableVisibilityClass($show_columns) {
    return $show_columns ? 'show' : 'hide';
}

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

$error_message = ""; // Biến lưu trữ thông báo lỗi

if (isset($_POST['btn'])) {
    $input = trim($_POST['input']); // Sử dụng trim() để loại bỏ khoảng trắng từ đầu và cuối chuỗi
    if (!empty($input)) {
        $show_columns = true;
        // require 'db/connect.php';

        $search_sql = "SELECT * FROM qualitycompany WHERE decription LIKE :input OR decription_vn LIKE :input ORDER BY quality DESC";
        $stmt = $conn->prepare($search_sql);
        $stmt->bindValue(':input', '%' . $input . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error_message = "Vui lòng nhập thông tin tìm kiếm.";
        $show_columns = false; // Không hiển thị bảng nếu không có thông tin tìm kiếm
    }
} else {
    $input = false;
    $show_columns = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/Search.css">
    <link rel="stylesheet" href="css/Table.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .logo-column img {
            width: 100px; /* Đặt kích thước tối đa cho hình ảnh logo */
            height: auto; }

            h1, h2, h3, p {
            font-family: 'Montserrat', sans-serif;
            }
        body {
            background: rgb(79,217,255);
            background: linear-gradient(90deg, rgba(79,217,255,1) 0%, rgba(0,197,166,1) 35%, rgba(212,212,193,1) 100%);
            font-family: 'Montserrat', sans-serif;
        }

        .Search {
        /* Additional styles for the Search container if needed */
         }
        table {
        background-color: white;
        
        }
        .Search-Navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;}
        
        #input {
        width: 500px; 
        height: 55px; 
        font-size: 16px; 
        margin-bottom: 50px;
        border-radius: 20px 20px 20px 20px;

    }
    .img1,.img2 {
        position: absolute;
        bottom: 0;
        width: 500px; /* Adjust width as needed */
        height: auto; /* Maintain aspect ratio */
    }
    .img1 {
        left: 0;
    }

    .img2 {
        right:0;
    }
    .btn.btn-primary{
        color: white;
        background-color:#257266;
        width: 120px;
        height: 55px;;
        margin-bottom: 2px;
        border-radius: 20px 20px 20px 20px;
    }
    .img-container{
        z-index: -1;
    }
    .Search-title{
        color: white    ;
        padding: 10px;
        
        
    }
    .Search-title h3{
        font-size: 40px;
        font-weight: bold;
        text-shadow: 2px 2px 4px #000000;

    }
    .img{
        margin-top: 20px;
    }
    .contact {
    color: #257266; /* Màu cho liên kết "Contact" */
    text-decoration: none; /* Xóa gạch chân mặc định */
    font-weight: bold;
    font-size:20px ;
    }

    .contact:hover {
        text-decoration: underline; /* Hiển thị gạch chân khi rê chuột qua */
        
    }
    .info{
        color: #257266; /* Màu cho liên kết "Contact" */
        text-decoration: none; /* Xóa gạch chân mặc định */
        font-weight: bold;
        font-size:20px ;
    }
    .info:hover {
        text-decoration: underline; /* Hiển thị gạch chân khi rê chuột qua */
    }
    .decription_vn{
        width: 200px;;
    }
    .hide {
    display: none;
}

    .show {
        display: block;
    }

    </style>
</head>

<body>
    <div class="Search">
        <div class="Search-Navbar">
            <img src="IMG/logo1.png"class="img">
            <div class="img-container">
                    <img src="IMG/left.png" class="img1">
                    <img src="IMG/right.png" class="img2">
            </div>

            <div class="Search-Navbar-menu">
                <img src="" class="img-contact">
                <p><a href="https://www.facebook.com/profile.php?id=100028737245911" class="contact">Contact</a></p>
                <p><a href="https://www.facebook.com/profile.php?id=100028737245911" class="info">Info</a></p>
                <p><a href="loginu.php" class="loginu">login</a></p>
                <!-- <p><a href="process_add_post.php" class="process_add_post.php">Đánh giá công ty</a></p> -->
    </div>
        </div>
        <div class="Search-title">
            <h3>Tìm kiếm công ty phần mềm theo nhu cầu của bạn</h3>
        </div>
        <form method="post">
            <!-- Thông báo lỗi -->
            <?php if (!empty($error_message)) : ?>
                <p><?php echo $error_message; ?></p>
            <?php endif; ?>
            <!-- <label for="input">Hãy nhập tên công ty bạn muốn!</label><br> -->
            <input type="text" name="input" placeholder="Nhập từ khóa bạn muốn tìm kiếm" id="input">
            <button type="submit" name="btn" class="btn btn-primary">Tìm kiếm</button>
        </form>
        <div class="<?php echo getTableVisibilityClass($show_columns); ?>">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Company</th>
                <th>Decription_vn</th>
                <th>Quality</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($show_columns) {
                foreach ($results as $row) {
                    echo "<tr>
                            <td class='logo-column'><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Logo'></td>
                            <td>{$row['namecompany']}</td>
                            <td class='decription_vn'>{$row['decription_vn']}</td>
                            <td>{$row['quality']}</td>
                            <td><a href=\"{$row['link']}\">{$row['link']}</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có kết quả tìm kiếm.</td></tr>";
            }
            ?>
        


                </tbody>
            </table>
        </div>
    </div>
</body>

</html>