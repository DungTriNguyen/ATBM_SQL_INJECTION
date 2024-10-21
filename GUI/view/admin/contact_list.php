<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php')?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách liên hệ</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
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
    <div class="container-sb" >
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>  
            
            <div class="content-page">
                <div class="container-fluid">
                    <div class="admin-header">
                            <div class="admin-header-l">
                                <h1 class="header-l">Danh sách liên hệ</h1>
                            </div>
                            <div class="admin-header-r">
                                <ul class="header-r-list">
                                    <li class="header-r-item">
                                        <a href="./Tongquan.php">Home</a>
                                    </li>
                                    <li class="header-r-item">Danh sách liên hệ</li>
                                </ul>
                            </div>
                    </div>

                    <div class="admin-contact-noti">
                        <div class="admin-contact-notiAccept" style="display: none;">
                            Xóa liên hệ thành công
                        </div>
                        <div class="admin-contact-notiError" style="display: none;">
                            Không tồn tại liên hệ
                        </div>
                    </div>
                    

                    <hr>

                    <div class="admin-filter">
                        <div class="admin-filter-bottom">
                            <div class="admin-filter-bleft">
                                    <input id="input-search-username" class="filter-b-item100 form-control filter-b-item ml-10" type="text" placeholder="Nhập tên khách hàng">
                            </div>
                            <div class="admin-filter-bright">
                                <input id="input-search-email" class="filter-b-item70 form-control filter-b-item mr-10" type="text" placeholder="Nhập email khách hàng">
                                <button id="submit-contact" type="submit" class="filter-b-item30 filter-b-item filter-b-btn">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="admin-table-contact">
                        <table class="admin-table-list">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="">Họ tên</th>
                                    <th width="">Email</th>
                                    <th width="">Lời nhắn</th>
                                    <th width="">Trả lời</th>
                                    <th width="">Thời gian</th>
                                    <th width="">Sửa</th>
                                    <th width="">Xóa</th>

                                </tr>
                            </thead>
                            <tbody id="feedBackList" class="fetch-data-table">
                            
                            </tbody> 
                        </table>
                    </div>

                    <nav aria-label="Page navigation example" class="admin-pageNav">
                        <ul class="admin-pageNav-list" id="list-page">
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
    <!-- Modal sửa -->
    <div id="edit-feedback">
    </div>
    <!-- Modal xóa-->
    <div id="delete-feedback">
    </div>

    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/feedback.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>