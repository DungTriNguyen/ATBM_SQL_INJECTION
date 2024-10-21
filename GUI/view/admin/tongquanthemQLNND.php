<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
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
                    <h1>THÊM NHÓM NGƯỜI DÙNG</h1> <!-- Sửa title -->
                    <form action="" class="permission-form">
                        <div class="form-group">
                            <label for="codePermission">Mã nhóm người dùng mới:</label>
                            <input type="text" id="codePermission" class="form-control" required>
                            <label for="namePermission">Tên nhóm người dùng mới:</label>
                            <input type="text" id="namePermission" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="addObj(event)">Cập nhật</button>
                            <!-- Sửa nút cập nhật -->
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
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/addusergroup.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>