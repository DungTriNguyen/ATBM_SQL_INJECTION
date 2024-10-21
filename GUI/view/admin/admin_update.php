<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật</title>

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
                                <h1 class="header-l">Cập nhật trạng thái</h1>
                            </div>
                            <div class="admin-header-r">
                                <ul class="header-r-list">
                                    <li class="header-r-item">
                                        <a href="./Tongquan.php">Home</a>
                                    </li>
                                    <li class="header-r-item">Cập nhật trạng thái</li>
                                </ul>
                            </div>
                    </div>
                </div>
                <hr>

                <div class="container-detail-page">

                <div class="form-group">
                    <label class="update-label" for="">Tên trạng thái</label>
                    <input class="form-control bill-update-form" type="text" name="name" placeholder="Nhập tên trạng thái" value="Đang chuẩn bị hàng">
                </div>
                <div class="form-group">
                    <label class="update-label" for="">Mô tả</label>
                    <textarea class="form-control bill-update-form" name="description" cols="30" rows="10">Đang chuẩn bị đơn hàng</textarea>
                </div>

                    <hr>

                    <div class="bill-update-btn">
                        <button type="submit" class="filter-b-btn">Cập nhập trạng thái</button>
                        <a href="#" class="">Quay lại</a>
                    </div>
                    
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