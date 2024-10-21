<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
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

            <div class="content-page" style="min-height:620px;">
                <div class="container-fluid">
                    <div class="admin-header">
                        <div class="admin-header-l">
                            <h1 class="header-l">Danh sách đánh giá</h1>
                        </div>
                        <div class="admin-header-r">
                            <ul class="header-r-list">
                                <li class="header-r-item">
                                    <a href="./Tongquan.php">Home</a>
                                </li>
                                <li class="header-r-item">Danh sách đánh giá</li>
                            </ul>
                        </div>
                    </div>
                    <hr>

                    <div class="mb-3 mt-5">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm" id="input-search">
                            <button class="btn btn-primary">Tìm kiếm <i class="fa fa-search" style="font-size: 14px;"></i></button>
                        </div>
                    </div>

                    <hr>

                    <div class="admin-table-contact">
                        <table class="admin-table-list">
                            <thead>
                                <tr>
                                    <th width="">Mã bình luận</th>
                                    <th width="16%">Tài khoản bình luận</th>
                                    <th width="">Mã sản phẩm</th>
                                    <th width="">Số lượt thích</th>
                                    <th width="25%">Bình luận</th>
                                    <th width="">Thời gian</th>
                                    <th width="">Trạng thái</th>
                                    <th width="">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="listComment">
                                <tr>
                                    <td>1</td>
                                    <td>TienHai488</td>
                                    <td>Áo Sơ Mi Cộc Tay Adidas Màu Đen Xám</td>
                                    <td>3</td>
                                    <td>Binh luan cho san pham tesst chuc nawng</td>
                                    <td><a href="#" class="btn btn-danger">Ẩn</a></td>

                                    <td>14/04/2023 20:43:25</td>
                                    </td>
                                    <td><a href="#" onclick="" class="btn-table-warning"><i class="fa fa-trash"></i>
                                            Xóa</a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>TienHai488</td>
                                    <td>tienhai4888@gmail.com</td>
                                    <td>Áo Sơ Mi Cộc Tay Adidas Màu Đen Xám</td>
                                    <td>3</td>
                                    <td>Binh luan cho san pham tesst chuc nawng</td>
                                    <td><button href="#" class="btn btn-primary">Hiện</button></td>

                                    <td>14/04/2023 20:43:25</td>
                                    </td>
                                    <td><a href="#" onclick="" class="btn-table-warning"><i class="fa fa-trash"></i>
                                            Xóa</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <ul class="pagination pagination-sm justify-content-end" id="Pagination" style="margin-right:.25rem; cursor:pointer;">
                <!-- <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">Previous</a></li>
                    <li class="admin-pageNav-item active"><a class="admin-pageNav-link" href="">1</a></li>
                    <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">2</a></li>
                    <li class="admin-pageNav-item"><a class="admin-pageNav-link " href="">Next</a></li> -->
            </ul>
            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>

    <div id="editState">

    </div>

    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/comment.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>