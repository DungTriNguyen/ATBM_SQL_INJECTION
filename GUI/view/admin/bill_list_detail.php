<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết hóa đơn</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        <?php
        require('../../css/admin/bill_list_admin.css');
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
                <div class="container-fluid">
                    <div class="admin-header">
                        <div class="admin-header-l">
                            <h1 class="header-l">Chi tiết hóa đơn</h1>
                        </div>
                        <div class="admin-header-r">
                            <ul class="header-r-list">
                                <li class="header-r-item">
                                    <a href="./Tongquan.php">Home</a>
                                </li>
                                <li class="header-r-item">Chi tiết hóa đơn</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="container-detail-page">
                    <div id="data-order" class="admin-container-detail">
                        <div><span>Họ tên: </span>Le Tien Hai</div>
                        <div><span>Số điện thoại: </span>0987654321</div>
                        <div><span>Địa chỉ: </span>Ho Chi Minh Viet Nam</div>
                        <div><span>Ghi chú: </span></div>
                        <div><span>Trạng thái: </span>Chờ duyệt</div>
                        <div><span>Tổng tiền: </span>21600</div>
                        <div><span>Thời gian: </span>2023-05-08 11:31:33</div>
                    </div>

                    <hr>

                    <table class="admin-table-list">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Mã kích thước</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody id="data-orderdetail-table">
                            <tr>
                                <td>1</td>
                                <td>Áo Hoodie Puma Power Knit Training</td>
                                <td><img src="" style="width:60px"></td>
                                <td>2XL</td>
                                <td>1200</td>
                                <td>18</td>
                                <td>21600</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <a href="./bill_list.php" class="admin-billDetail-btnAndBack">Quay lại</a>

                </div>
            </div>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/bill_list_detail.js?v=<?php echo $version ?>"></script>
</body>

</html>