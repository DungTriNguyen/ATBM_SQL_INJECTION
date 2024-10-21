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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/admin/tongquan.css?v=<?php echo time(); ?>">
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
                    <p class="title">Tổng quan</p>
                    <div class="path"><a href="#!">Home</a> <span> / Tổng quan</span></div>
                </div>
                <div class="stat">
                    <div class="item-stat">
                        <div class="number sub-stat"><span id="number-buy">24</span>
                            <p>Số sản phẩm đã bán</p>
                        </div>
                        <div class="icon-stat "><i class="fa-solid fa-bag-shopping"></i></div>
                    </div>
                    <!-- <div class="item-stat">
                        <div class="number sub-stat"><span>25%</span>
                            <p>Tỉ lệ hủy đơn</p>
                        </div>
                        <div class="icon-stat "><i class="fa-solid fa-chart-simple"></i></div>
                    </div> -->
                    <div class="item-stat">
                        <div class="number sub-stat"><span id="revenue">185800</span>
                            <p>Doanh thu</p>
                        </div>
                        <div class="icon-stat "><i class="fa-solid fa-chart-pie"></i></div>
                    </div>
                </div>
                <div class="filter-chart">
                    <div class="filter">
                        <div class="search">
                            <span>Tìm kiếm sản phẩm</span>
                            <select id="type-product">
                                <option value="0" selected>Lựa chọn sản phẩm theo danh mục</option>
                                <option value="1">Áo</option>
                                <option value="2">Túi sách</option>
                            </select>
                        </div>
                        <div class="toDate">Từ ngày <input id="toDate" type="date"></div>
                        <div class="endDate">Đến ngày <input id="endDate" type="date"></div>
                        <div style="cursor: pointer;" id="buttonSearch" onclick="ThongKe()" class="buttonSearch">Thống kê <div class="button">Thống kê</div>
                        </div>
                    </div>
                    <div class="chart">
                        <div class="pie-chart">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="table-stat">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Giá bán</th>
                                <th>Danh mục</th>
                                <th>Đã bán</th>
                                <th>Hàng còn</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody id="data-table">
                            <tr>
                                <td>1</td>
                                <td>Áo Thun Adidas D4R Xanh</td>
                                <td><img src="../../image/product/product1/product-detail-1.png" alt=""></td>
                                <td>500</td>
                                <td>Áo Thun</td>
                                <td>137</td>
                                <td>116</td>
                                <td>68500</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Áo Thun Adidas D4R Xanh</td>
                                <td><img src="../../image/product/product1/product-detail-1.png" alt=""></td>
                                <td>500</td>
                                <td>Áo Thun</td>
                                <td>137</td>
                                <td>116</td>
                                <td>68500</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Áo Thun Adidas D4R Xanh</td>
                                <td><img src="../../image/product/product1/product-detail-1.png" alt=""></td>
                                <td>500</td>
                                <td>Áo Thun</td>
                                <td>137</td>
                                <td>116</td>
                                <td>68500</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Áo Thun Adidas D4R Xanh</td>
                                <td><img src="../../image/product/product1/product-detail-1.png" alt=""></td>
                                <td>500</td>
                                <td>Áo Thun</td>
                                <td>137</td>
                                <td>116</td>
                                <td>68500</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Áo Thun Adidas D4R Xanh</td>
                                <td><img src="../../image/product/product1/product-detail-1.png" alt=""></td>
                                <td>500</td>
                                <td>Áo Thun</td>
                                <td>137</td>
                                <td>116</td>
                                <td>68500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-sm justify-content-end mt-5" id="Pagination" style="cursor:pointer; margin-right:1rem;">
                    <li class="page-item"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li>
                </ul>
            </div>
            

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/tongquan.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>