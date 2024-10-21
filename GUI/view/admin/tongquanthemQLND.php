<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
    <?php require('../../css/admin/sidebar.css');
    require('../../css/admin/header_admin.css');
    require('../../css/admin/footer_admin.css');
    require('../../css/admin/QLND.css');
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
                <h1>THÊM NGƯỜI DÙNG</h1>
                <form action="">
                    <div class="form-container">
                        <div class="inputtotal">
                            <div class="input1">
                                <div class=" form-group">
                                    <label for="ho_ten">Tên đăng nhập:</label>
                                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập">
                                </div>
                                <div class="form-group">
                                    <label for="mat_khau">Mật khẩu:</label>
                                    <input type="password" id="passWord" name="mat_khau" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="nhap_lai_mat_khau">Nhập lại mật khẩu:</label>
                                    <input type="password" id="confirmPassWord" name="confirmPassWord"
                                        placeholder="Nhập lại mật khẩu">
                                </div>


                                <input type="hidden" id="dateCreated" name="dateCreated">

                                <div class=" form-group">
                                    <label for="ho_ten">Họ tên:</label>
                                    <input type="text" id="name" name="name" placeholder="Nhập họ tên">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="address" id="address" name="address" placeholder="Nhập địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="so_dien_thoai">Số điện thoại:</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber"
                                        placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="input2">
                                <div class="form-group">
                                    <label for="date">Ngày sinh:</label>
                                    <input type="date" id="birth" name="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="sex">Giới tính:</label>
                                    <select id="sex" name="sex">
                                        <option value="Male">Nam</option>
                                        <option value="Female">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nhom_nguoi_dung">Nhóm người dùng:</label>
                                    <select id="codePermission" name="codePermissions">
                                        <option value="">Chọn nhóm người dùng</option>
                                        <option value="1">Quản trị viên</option>
                                        <option value="2">Nhân viên</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="trang_thai_nguoi_dung">Trạng thái người dùng:</label>
                                    <select id="accountStatus" name="accountStatus">
                                        <option value="">Chọn trạng thái người dùng</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Chưa kích hoạt</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="kieu_nguoi_dung">Kiểu người dùng:</label>
                                    <select id="kieu_nguoi_dung" name="kieu_nguoi_dung">
                                        <option value="">Chọn kiểu người dùng</option>
                                        <option value="1">Người dùng</option>
                                        <option value="2">Khách hàng</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="addObj(event)">Thêm người
                            dùng</button>
                        <a href="./tongquanQLND.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>

        </div>
        <div class="footer">
            <?php require('./footer_admin.php'); ?>
        </div>
    </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/adduser.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>