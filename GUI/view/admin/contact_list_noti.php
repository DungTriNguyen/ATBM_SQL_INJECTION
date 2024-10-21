<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách theo dõi</title>

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
                                <h1 class="header-l">Danh sách theo dõi</h1>
                            </div>
                            <div class="admin-header-r">
                                <ul class="header-r-list">
                                    <li class="header-r-item">
                                        <a href="./Tongquan.php">Home</a>
                                    </li>
                                    <li class="header-r-item">Danh sách theo dõi</li>
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
                                    <select class="form-control filter-b-item50 filter-b-item">
                                        <option class="" value="0">Chọn trạng thái</option>
                                        <option value="1">Chưa xử lí</option><option value="2">Đang xử lí</option><option value="3">Đã xử lí</option>
                                    </select>
                            </div>
                            <div class="admin-filter-bright">
                            <input class="filter-b-item70 form-control filter-b-item mr-10" type="text" placeholder="Nhập email khách hàng">
                            <button type="submit" class="filter-b-item30 filter-b-item filter-b-btn">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="admin-table-contactNoti">
                        <table class="admin-table-list">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="">Email</th>
                                    <th width="">Trạng thái</th>
                                    <th width="">Ghi chú</th>
                                    <th width="">Thời gian</th>
                                    <th width="">Sửa</th><th width="">Xóa</th>                </tr>
                            </thead>
                            <tbody class="fetch-data-table"><tr>
                        <td>1</td>
                            <td>ngochuy@gmail.com</td>
                            <td><a href="#" class="btn-table-warning dis-pointed-hover">Chưa xử lý</a></td>
                            <td>Chưa xử lý</td>
                            <td>17/04/2023 14:30:36</td>
                            
                            
                            <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td><td><a href="#" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn-table-warning"><i class="fa fa-trash"></i>
                                Xóa</a></td></tr><tr>
                        <td>2</td>
                            <td>tienhai488@gmail.com</td>
                            <td><a href="#" class="btn-table-warning dis-pointed-hover">Chưa xử lý</a></td>
                            <td>Chưa xử lý</td>
                            <td>14/04/2023 20:12:38</td>
                            
                            
                            <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td><td><a href="#" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn-table-warning"><i class="fa fa-trash"></i>
                                Xóa</a></td></tr><tr>
                        <td>3</td>
                            <td>email@gmail.com</td>
                            <td><a href="#" class="btn-table-warning dis-pointed-hover">Chưa xử lý</a></td>
                            <td>Chưa xử lý</td>
                            <td>12/04/2023 22:24:42</td>
                            
                            
                            <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td><td><a href="#" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn-table-warning"><i class="fa fa-trash"></i>
                                Xóa</a></td></tr><tr>
                        <td>4</td>
                            <td>manhtuan@gmail.com</td>
                            <td><a href="#" class="btn-table-warning dis-pointed-hover">Chưa xử lý</a></td>
                            <td>Chưa xử lý</td>
                            <td>02/04/2023 10:17:56</td>
                            
                            
                            <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td><td><a href="#" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn-table-warning"><i class="fa fa-trash"></i>
                                Xóa</a></td></tr><tr>
                        <td>5</td>
                            <td>tienhai@gmail.com</td>
                            <td><a href="#" class="btn-table-warning dis-pointed-hover">Chưa xử lý</a></td>
                            <td>Chưa xử lý</td>
                            <td>02/04/2023 10:17:23</td>
                            
                            
                            <td><a href="./admin_update.php" class="btn-table-billUpdate"><i class="fa fa-edit"></i> Sửa</a></td><td><a href="#" onclick="return confirm('Bạn có thật sự muốn xóa!') " class="btn-table-warning"><i class="fa fa-trash"></i>
                                Xóa</a></td></tr></tbody>
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