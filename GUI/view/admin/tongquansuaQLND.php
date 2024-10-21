<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SỬA NGƯỜI DÙNG</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
                <h1>SỬA NGƯỜI DÙNG </h1>
                <form action="them-nguoi-dung.php" method="post" onsubmit="return validateForm()">
                    <div class="form-container">
                        <div class="inputtotal">
                            <div class="input1">
                                <div class="form-group">
                                    <label for="ho_ten">Họ tên:</label>
                                    <input type="text" id="ho_ten" name="ho_ten" placeholder="Nhập họ tên">
                                </div>
                                <div class="form-group">
                                    <label for="mat_khau">Mật khẩu:</label>
                                    <input type="password" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="nhap_lai_mat_khau">Nhập lại mật khẩu:</label>
                                    <input type="password" id="nhap_lai_mat_khau" name="nhap_lai_mat_khau" placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="so_dien_thoai">Số điện thoại:</label>
                                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại">
                                </div>
                            </div>

                            <div class="input2">
                                <div class="form-group">
                                    <label for="nhom_nguoi_dung">Nhóm người dùng:</label>
                                    <select id="nhom_nguoi_dung" name="nhom_nguoi_dung">
                                        <option value="">Chọn nhóm người dùng</option>
                                        <option value="1">Quản trị viên</option>
                                        <option value="2">Nhân viên</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="trang_thai_nguoi_dung">Trạng thái người dùng:</label>
                                    <select id="trang_thai_nguoi_dung" name="trang_thai_nguoi_dung">
                                        <option value="">Chọn trạng thái người dùng</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Chưa kích hoạt</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kieu_nguoi_dung">Kiểu người dùng:</label>
                                    <select id="kieu_nguoi_dung" name="kieu_nguoi_dung">
                                        <option value="">Chọn kiểu người dùng</option>
                                        <option value="1">Người dùng</option>
                                        <option value="2">Khách hàng</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="./tongquanQLND.php" class="btn btn-secondary">Quay lại
                        </a>
                    </div>
                </form>
            </div>
            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/sidebar.js"></script>
</body>

</html>