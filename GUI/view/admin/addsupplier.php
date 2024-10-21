<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhà cung cấp mới</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        <?php require('../../css/admin/sidebar.css');
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
            <div class="content-page-sb ">
                <div style="width: 1150px;">
                    <h2 style="text-align:center;">Thêm nhà cung cấp</h2>
                    <div class="container-fluid">
                        <form id="addForm">
                            <div class="mb-3">
                                <label for="supplierCode" class="form-label">Mã nhà cung cấp</label>
                                <input type="text" class="form-control" id="supplierCode" name="supplierCode">
                            </div>
                            <div class="mb-3">
                                <label for="nameSupplier" class="form-label">Tên nhà cung cấp</label>
                                <input type="text" class="form-control" id="nameSupplier" name="nameSupplier">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="brandSupplier" class="form-label">Thương hiệu cung cấp</label>
                                <input type="text" class="form-control" id="brandSupplier" name="brandSupplier">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                            </div>
                            <div class="group-btn" style="text-align:right; margin-bottom: 2rem;">
                                <a href="./list-suppliers.php" type="" class="btn btn-primary">Quay lại</a>
                                <button type="submit" class="btn btn-primary" onclick="addObj(event)">Thêm nhà cung
                                    cấp</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/addsupplier.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>