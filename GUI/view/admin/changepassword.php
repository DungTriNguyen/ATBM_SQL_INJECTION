<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php')?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin/tongquan.css">
    <style>
        <?php
        require('../../css/admin/sidebar.css');
        require('../../css/admin/header_admin.css');
        require('../../css/admin/footer_admin.css');
        ?>
 </style>
</head>
<body>
    <div class="container-sb">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
            <?php require('./header_admin.php'); ?>
            </div>  
            <div class="content-page">
                <div class="head-content">
                    <p class="title">Đổi mật khẩu</p>
                    <div class="path"><a href="#!">Home</a> <span> / Đổi mật khẩu</span></div>
                </div>
                <div style="max-width: 1200px;margin:0 auto; ">
                    <form method="POST" action="">
                        <div class="form-group mb-3">
                            <label class="mb-1 fs-5" for="">Nhập mật khẩu hiện tại</label>
                            <input id="password" class="form-control" type="password" name="password" placeholder="Nhập mật khẩu hiện tại" value="">
                                    </div>
                        <div class="form-group mb-3">
                            <label class="mb-1 fs-5" for="">Mật khẩu mới</label>
                            <input id="new_password" class="form-control" type="password" name="new_password" placeholder="Nhập mật khẩu mới" value="">
                                    </div>
                        <div class="form-group mb-3">
                            <label class="mb-1 fs-5" for="">Nhập lại mật khẩu mới</label>
                            <input id="repeat_password" class="form-control" type="password" name="repeat_password" placeholder="Nhập lại mật khẩu mới" value="">
                                    </div>
                        <button onclick="submitChangePass(event)" type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        <p><a href="../admin/Tongquan.php">Quay lại</a></p>

                    </form>
                </div>
            </div>

            <div class="footer">
            <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/changePassWord_admin.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>