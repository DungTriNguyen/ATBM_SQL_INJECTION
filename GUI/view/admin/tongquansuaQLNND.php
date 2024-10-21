<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        <?php require('../../css/admin/sidebar.css');
        require('../../css/admin/header_admin.css');
        require('../../css/admin/footer_admin.css');
        // require('../../css/admin/danhsachnguoidung2.css');
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
                <div class="form-container">
                    <h1>SỬA NHÓM NGƯỜI DÙNG</h1> <!-- Sửa title -->
                    <form action="update_permission.php" method="post" class="permission-form">
                        <input type="hidden" id="codePermissions" name="codePermissions" value="<?php echo $_GET['codePermissions']; ?>">
                        <div class="form-group">
                            <label for="newNamePermissions">Tên Mới:</label>
                            <input type="text" id="newNamePermissions" name="newNamePermissions" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cập nhật</button> <!-- Sửa nút cập nhật -->
                            <a href="./TongquanQLNND.php" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/sidebar.js"></script>
</body>

</html>