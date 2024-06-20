<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['pass'])) {
    header("location: login.php");
    exit();
}

require 'db/connect.php';


if (isset($_POST['btn-reg'])) {
    $description = $_POST['decription'];
    $description_vn = $_POST['decription_vn'];
    $namecompany = $_POST['namecompany'];
    $performance = $_POST['performace'];
    $accessibility = $_POST['accessibility'];
    $seo = $_POST['seo'];
    $bestpractices = $_POST['bestpractices'];
    $quality = $_POST['quality'];
    $security = $_POST['security'];
    $link = $_POST['link'];
    

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Read the image file
        $image_tmp_name = $_FILES['image']['tmp_name'];
        
        // Check if the file is an actual image
        if (getimagesize($image_tmp_name) !== false) {
            $image_data = file_get_contents($image_tmp_name);
    
            // Update the image data in the database
            try {
                $sql_insert_image = "INSERT INTO qualitycompany (image) VALUES (:image)";
                $stmt_image = $conn->prepare($sql_insert_image);
                $stmt_image->bindParam(':image', $image_data, PDO::PARAM_LOB);
    
                if ($stmt_image->execute()) {
                    echo "Lưu trữ hình ảnh thành công";
                } else {
                    echo "Lỗi khi lưu trữ hình ảnh";
                }
            } catch (PDOException $e) {
                echo "Lỗi: " . $e->getMessage();
            }
        } else {
            echo "Lỗi: Đây không phải là một tệp hình ảnh hợp lệ.";
        }
    } else {
        echo "Lỗi: Không thể tải lên tệp hình ảnh.";
    }
    
    
    if (!empty($description) && !empty($description_vn) && !empty($namecompany) && !empty($performance) && !empty($accessibility) && !empty($seo) && !empty($bestpractices) && !empty($quality) && !empty($security) && !empty($link)) {
        $sql = "INSERT INTO qualitycompany (decription, decription_vn, namecompany, performace, accessibility, seo, bestpractices, quality, security, link) VALUES (:decription, :decription_vn, :namecompany, :performace, :accessibility, :seo, :bestpractices, :quality, :security, :link)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':decription', $description, PDO::PARAM_STR);
        $stmt->bindParam(':decription_vn', $description_vn, PDO::PARAM_STR);
        $stmt->bindParam(':namecompany', $namecompany, PDO::PARAM_STR);
        $stmt->bindParam(':performace', $performance, PDO::PARAM_STR);
        $stmt->bindParam(':accessibility', $accessibility, PDO::PARAM_STR);
        $stmt->bindParam(':seo', $seo, PDO::PARAM_STR);
        $stmt->bindParam(':bestpractices', $bestpractices, PDO::PARAM_STR);
        $stmt->bindParam(':quality', $quality, PDO::PARAM_STR);
        $stmt->bindParam(':security', $security, PDO::PARAM_STR);
        $stmt->bindParam(':link', $link, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Lưu trữ thành công";
            header("Location: admin.php");
            exit();
        } else {
            echo "Lỗi: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Bạn cần nhập đủ thông tin";
    }
}
?>