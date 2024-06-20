
<?php 
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['pass'])){
        header("location: login.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>them</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div id="wrapper">
        <div class="container">
            <div class="row justify-content-around">
                <form action="reg.php" method="post" class="col-md-6 bg-light p-3 my-3" enctype="multipart/form-data">
                    <h1 class="text-center text-uppercase h3 py-3">Nhập liệu</h1>
                    
                    <div class="form-group">
                        <label for="decription">Decription</label>
                        <input type="text" name="decription" id="decription" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="decription_vn">Decription_vn</label>
                        <input type="text" name="decription_vn" id="decription_vn" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="namecompany">Name company</label>
                        <input type="text" name="namecompany" id="namecompany" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="performace">Performace</label>
                        <input type="text" name="performace" id="performace" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="accessibility">Accessibility</label>
                        <input type="text" name="accessibility" id="accessibility" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="seo">SEO</label>
                        <input type="text" name="seo" id="seo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bestpractices">Best practices</label>
                        <input type="text" name="bestpractices" id="bestpractices" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quality">Quality</label>
                        <input type="text" name="quality" id="quality" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="security">Security</label>
                        <input type="text" name="security" id="security" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control">
                    </div>
                    <div class="form-group">
                         <input type="file" name="image">
                         
                    </div>                    
                    <input type="submit" value="Thêm Mới" class="btn-primary btn btn-block" name="btn-reg">
                    <a href="admin.php" class="btn-primary btn btn-block">huy</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>