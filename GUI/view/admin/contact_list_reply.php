<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trả lời liên hệ</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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
    <div class="container">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>  
            
            <div class="content-page">
                <div class="container-fluid">
                    <div class="admin-header">
                            <div class="admin-header-l">
                                <h1 class="header-l">Trả lời liên hệ</h1>
                            </div>
                            <div class="admin-header-r">
                                <ul class="header-r-list">
                                    <li class="header-r-item">
                                        <a href="./Tongquan.php">Home</a>
                                    </li>
                                    <li class="header-r-item">Trả lời liên hệ</li>
                                </ul>
                            </div>
                    </div>
                </div>
                <hr>

                <div class="container-detail-page">

                <div class="form-group">
                    <label class="update-label" for="">Lời nhắn</label>
                    <input class="form-control bill-update-form" type="text" name="name" placeholder="Lời nhắn của khách hàng" value="Cần thêm khuyến mãi abcxyz" disabled>
                </div>
                <div class="form-group">
                    <label class="update-label" for="">Trả lời</label>
                    <textarea class="form-control bill-update-form" name="description" cols="30" rows="10">Okay, cảm ơn vì đã đóng góp ý kiến</textarea>
                </div>

                    <hr>

                    <div class="bill-update-btn">
                        <button type="submit" class="filter-b-btn btn-short">Gửi</button>
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