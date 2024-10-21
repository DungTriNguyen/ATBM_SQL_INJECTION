<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách trạng thái đơn hàng</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
                                <h1 class="header-l">Danh sách trạng thái đơn hàng</h1>
                            </div>
                            <div class="admin-header-r">
                                <ul class="header-r-list">
                                    <li class="header-r-item">
                                        <a href="./Tongquan.php">Home</a>
                                    </li>
                                    <li class="header-r-item">Danh sách trạng thái đơn hàng</li>
                                </ul>
                            </div>
                    </div>
                    <a href="" class="admin-billDetail-btnAndBack">
                        <i class="fa fa-plus"></i>Thêm trạng thái
                    </a>
                    <hr>
                    
                    <div class="admin-table-detail">
                        <table class="admin-table-list">
                                    <thead>
                                        <tr>
                                            <th width="5%">STT</th>
                                            <th width="">Trạng thái</th>
                                            <th width="">Mô tả</th>
                                            <th width="">Thời gian</th>
                                            <th width="8%">Sửa</th>
                                            <!-- <th width="8%">Xóa</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="fetch-data-table"><tr>
                                <td>1</td>
                                    <td>Đang chuẩn bị hàng</td>
                                    <td>Đang chuẩn bị đơn hàng</td>
                                    <td>07/05/2023 23:17:15</td>
                                    <td><a href="http://localhost/web2_template/admin/order_status/update/3" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                    </tr>
                                    <tr>
                                <td>2</td>
                                    <td>Thành công</td>
                                    <td>Giao hàng thành công</td>
                                    <td>30/03/2023 08:27:30</td>
                                    <td><a href="http://localhost/web2_template/admin/order_status/update/6" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                    </tr>
                                    <tr>
                                <td>3</td>
                                    <td>Đang giao</td>
                                    <td>Đang được giao</td>
                                    <td>30/03/2023 08:26:56</td>
                                    <td><a href="http://localhost/web2_template/admin/order_status/update/5" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                    </tr>
                                    <tr>
                                <td>4</td>
                                    <td>Hủy đơn</td>
                                    <td>Đơn hàng bị hủy bỏ</td>
                                    <td>30/03/2023 08:26:35</td>
                                    <td><a href="http://localhost/web2_template/admin/order_status/update/4" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                    </tr>
                                    <tr>
                                <td>5</td>
                                    <td>Đã duyệt</td>
                                    <td>duyệt</td>
                                    <td>22/03/2023 10:51:38</td>
                                    <td><a href="http://localhost/web2_template/admin/order_status/update/2" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td>
                                    </tr>
                                    </tbody>
                        </table>
                    </div>
                    
                    <nav aria-label="Page navigation example" class="admin-pageNav">
                        <ul class="admin-pageNav-list">
                            <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">Previous</a></li>
                            <li class="admin-pageNav-item active"><a class="admin-pageNav-link" href="">1</a></li>
                            <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">2</a></li>
                            <li class="admin-pageNav-item"><a class="admin-pageNav-link " href="">Next</a></li>
                        </ul>
                    </nav>
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