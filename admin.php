<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="css/Table.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <img src="IMG/logo1.png" class="img">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        h1,
        h2,
        h3,
        p {
            font-family: 'Montserrat', sans-serif;
        }

        .logo-column img {
            max-width: 100px;
            height: auto;
        }

        .Description_vn,
        .link {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .menu h3 {
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 4px #000000;
        }

        .img {
            width: 140px;
            height: auto;
        }

        .btn.btn-success {
            background: #257266;
        }

        .btn.btn-primary {
            background: #257266;
        }

        /* Responsive CSS */
        @media only screen and (max-width: 600px) {
            .logo-column img {
                max-width: 70px;
            }

            .Description_vn,
            .link {
                max-width: none;
                overflow: visible;
                white-space: normal;
            }
        }
    </style> -->
</head>

<body>
    <div class="Table">
        <div class="navbar">
        </div>
        <div class="content">
            <div class="menu">
                <h3>Danh sách công ty</h3>
                <div class="button-new">
                    <a class="btn btn-primary" href="them.php">Thêm mới</a>
                    <a class="btn btn-primary" href="logout.php">Đăng xuất</a>
                </div>
            </div>
            <div class="content-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Description</th>
                            <th>Description_vn</th>
                            <th>Company</th>
                            <th>Performance</th>
                            <th>Accessibility</th>
                            <th>SEO</th>
                            <th>BestPractices</th>
                            <th>SUM</th>
                            <th>Security</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db/connect.php';
                        try {
                            $sql = "SELECT * FROM qualitycompany ORDER BY quality DESC";
                            $stmt = $conn->query($sql);

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td class='logo-column'><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Logo'></td>
                                    <td class='Description'>" . $row['decription'] . "</td>
                                    <td class='Description_vn'>" . $row['decription_vn'] . "</td>
                                    <td>" . $row['namecompany'] . "</td>
                                    <td>" . $row['performace'] . "</td>
                                    <td>" . $row['accessibility'] . "</td>
                                    <td>" . $row['seo'] . "</td>
                                    <td>" . $row['bestpractices'] . "</td>
                                    <td>" . $row['quality'] . "</td>
                                    <td>" . $row['security'] . "</td>
                                    <td class='link'><a href=" . $row['link'] . ">" . $row['link'] . "</a></td>
                                    <td>
                                        <a class='btn btn-success' href='sua.php?id=" . $row['id'] . "'>sửa</a>
                                        <a class='btn btn-danger' href='xoa.php?id=" . $row['id'] . "'>xóa</a>
                                    </td>
                                </tr>";
                            }
                        } catch (PDOException $e) {
                            echo "Lỗi truy vấn: " . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
