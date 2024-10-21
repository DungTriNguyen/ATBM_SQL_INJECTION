<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hóa đơn</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
    <div class="container-fluid">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>

            <div class="content-page">
                <div class="container-fluid">
                    <div class="admin-header">
                        <div class="admin-header-l">
                            <h1 class="header-l">Danh sách hóa đơn</h1>
                        </div>
                        <div class="admin-header-r">
                            <ul class="header-r-list">
                                <li class="header-r-item">
                                    <a href="./Tongquan.php">Home</a>
                                </li>
                                <li class="header-r-item">Danh sách hóa đơn</li>
                            </ul>
                        </div>
                    </div>


                    <hr>

                    <div class="admin-filter">
                        <div class="admin-filter-top">
                            <div class="admin-filter-tleft">
                                <p class="filter-t-item filter-t-text">Từ ngày </p>
                                <input id="date-start" class="filter-t-item form-control" type="date">
                            </div>
                            <div class="admin-filter-tright">
                                <p class="filter-t-item filter-t-text">Đến ngày</p>
                                <input id="date-end" class="filter-t-item form-control" type="date">
                            </div>
                        </div>
                        <div class="admin-filter-bottom">
                            <div class="admin-filter-bleft">
                                <select id="state-order" class="form-control filter-b-item30 filter-b-item" style="padding: 0 .75rem!important;">
                                    <option value="empty">Chọn trạng thái</option>
                                    <option value="completed">Completed</option>
                                    <option value="processing">Processing</option>
                                    <option value="cancelled">Cancelled</option>

                                </select>
                                <input id="keyword-search" class="filter-b-item70 form-control filter-b-item ml-10" type="text" placeholder="Nhập từ khóa tìm kiếm" style="padding: 0 .75rem!important;">
                            </div>
                            <div class="admin-filter-bright">
                                <!-- <input class="filter-b-item70 form-control filter-b-item mr-10" type="text" placeholder="Nhập số điện thoại khách hàng" style="padding: 0 .75rem!important;"> -->
                                <button onclick="TimKiem()" type="submit" class="filter-b-item30 filter-b-item filter-b-btn">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="admin-table-bill">
                        <table class="admin-table-list">
                            <thead>
                                <tr>
                                    <th width="">Mã đơn hàng</th>
                                    <th width="">Họ tên</th>
                                    <th width="">Địa chỉ</th>
                                    <th width="">Ghi chú</th>
                                    <th width="">Tổng tiền</th>
                                    <th width="">Trạng thái</th>
                                    <th width="">Thời gian</th>
                                    <th width="">Chi tiết</th>
                                    <th width="">Sửa</th>
                                </tr>
                            </thead>
                            <tbody id="data-table" class="fetch-data-table">
                                <tr>
                                    <td>1</td>
                                    <td>Le Tien Hai</td>
                                    <td>0987654321</td>
                                    <td>Ho Chi Minh Viet Nam</td>
                                    <td></td>
                                    <td>21600</td>
                                    <td>Chờ duyệt</td>
                                    <td>08/05/2023 11:31:33</td>

                                    <td><a href="./bill_list_detail.php" class="btn-table-billDetail">Chi tiết</a></td>
                                    <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Le Tien Hai</td>
                                    <td>0987654321</td>
                                    <td>Ho Chi Minh Viet Nam</td>
                                    <td></td>
                                    <td>14300</td>
                                    <td>Chờ duyệt</td>
                                    <td>08/05/2023 11:22:55</td>

                                    <td><a href="./bill_list_detail.php" class="btn-table-billDetail">Chi tiết</a></td>
                                    <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i>Sửa</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Le Tien Hai</td>
                                    <td>0987654321</td>
                                    <td>Ho Chi Minh Viet Nam</td>
                                    <td></td>
                                    <td>42600</td>
                                    <td>Chờ duyệt</td>
                                    <td>08/05/2023 11:17:41</td>

                                    <td><a href="./bill_list_detail.php" class="btn-table-billDetail">Chi tiết</a></td>
                                    <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Le Tien Hai</td>
                                    <td>0987654321</td>
                                    <td>Ho Chi Minh Viet Nam</td>
                                    <td>.</td>
                                    <td>3600</td>
                                    <td>Thành công</td>
                                    <td>08/05/2023 09:55:55</td>

                                    <td><a href="./bill_list_detail.php" class="btn-table-billDetail">Chi tiết</a></td>
                                    <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Le Tien Hai</td>
                                    <td>0987654321</td>
                                    <td>Ho Chi Minh Viet Nam</td>
                                    <td>.</td>
                                    <td>500</td>
                                    <td>Chờ duyệt</td>
                                    <td>08/05/2023 09:54:55</td>

                                    <td><a href="./bill_list_detail.php" class="btn-table-billDetail">Chi tiết</a></td>
                                    <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- modal sửa -->
                    <div id="modal-fix-order">

                    </div>


                </div>
            </div>
            <ul class="pagination pagination-sm justify-content-end" id="Pagination" style="cursor:pointer; margin-right:1rem;">
                <li class="page-item"><a class="page-link">Previous</a></li>
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
                <li class="page-item"><a class="page-link">Next</a></li>
            </ul>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/list_order.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>