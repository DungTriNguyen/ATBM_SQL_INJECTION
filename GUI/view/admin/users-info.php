<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

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
                    <p class="title">Thông tin cá nhân</p>
                    <div class="path"><a href="../admin/Tongquan.php">Home</a> <span> / Thông tin cá nhân</span></div>
                </div>
                <div style="max-width: 1200px;margin:0 auto; ">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Tên người dùng</label>
                                <input id="username" class="form-control" type="text" disabled name="username" placeholder="Nhập họ tên" value="Tien Hai Le">
                            </div>
                            <div class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Họ tên</label>
                                <input id="name" class="form-control" type="text" name="fullname" placeholder="Nhập họ tên" value="Tien Hai Le">
                            </div>


                            <div class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Email</label>
                                <input id="mail" class="form-control" type="text" name="email" placeholder="Nhập email..." value="tienhai4888@gmail.com">
                            </div>

                            <div class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Số điện thoại</label>
                                <input id="phone" class="form-control" type="text" name="phone" placeholder="Nhập số điện thoại..." value="0987982144">
                            </div>


                            <div id="gender" class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Giới tính</label>
                                <select id="sex" class="form-control" name="sex">
                                    <option value="0">Nam</option>
                                    <option value="1" >Nữ</option>
                                </select>
                            </div>
                            <div class="col-6 form-group mb-3">
                                <label class="mb-1 fs-5" for="">Địa chỉ</label>
                                <input id="address" class="form-control" type="text" name="address" placeholder="Nhập địa chỉ..." value="330/18/13 Âu Dương Lân, phường 3, Quận 8, tp HCM">
                            </div>
                        </div>
                        <button id="submit" onclick="submitChangeInfor(event)" type="submit" class="btn btn-primary">Cập nhật</button>
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
    <script src="../../Js/admin/admin_infor.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>