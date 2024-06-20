<?php 
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['pass'])){
        header("location: login.php");
    }
?>

<?php
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
    $id = $_POST['id'];

    // Check if an image file was uploaded without errors
    if ($_FILES['image']['error'] == 0) {
        // Read the image file
        $image_data = file_get_contents($_FILES['image']['tmp_name']);

        // Update the image data in the database
        try {
            $sql_update_image = "UPDATE qualitycompany SET image=:image WHERE id=:id";
            $stmt_image = $conn->prepare($sql_update_image);
            $stmt_image->bindParam(':image', $image_data, PDO::PARAM_LOB);
            $stmt_image->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt_image->execute()) {
                echo "Lưu trữ hình ảnh thành công";
            } else {
                echo "Lỗi khi lưu trữ hình ảnh";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Continue with the update of other fields
    if (!empty($description)&&!empty($description_vn) && !empty($namecompany) && !empty($performance) && !empty($accessibility) && !empty($seo) && !empty($bestpractices) && !empty($quality) && !empty($security) && !empty($link)) {
        try {
            // Prepare the SQL statement
            $sql_update = "UPDATE qualitycompany SET decription_vn=:decription_vn, decription=:decription, namecompany=:namecompany, performace=:performace, accessibility=:accessibility, seo=:seo, bestpractices=:bestpractices, quality=:quality, security=:security, link=:link WHERE id=:id";
            $stmt = $conn->prepare($sql_update);

            // Bind the parameters
            $stmt->bindParam(':decription', $description);
            $stmt->bindParam(':decription_vn', $description_vn);
            $stmt->bindParam(':namecompany', $namecompany);
            $stmt->bindParam(':performace', $performance);
            $stmt->bindParam(':accessibility', $accessibility);
            $stmt->bindParam(':seo', $seo);
            $stmt->bindParam(':bestpractices', $bestpractices);
            $stmt->bindParam(':quality', $quality);
            $stmt->bindParam(':security', $security);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':id', $id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Lưu trữ thông tin thành công";
                header("Location: admin.php");
                exit;
            } else {
                echo "Lỗi khi thực thi câu lệnh SQL";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "Bạn cần nhập đủ thông tin!";
        

    }
}
