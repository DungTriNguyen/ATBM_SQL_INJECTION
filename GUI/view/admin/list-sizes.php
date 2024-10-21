<html lang="en">
<?php require('../../../config.php')?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Size</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <div class="content-page-sb ">
            <div class="container-product">
                    <div class="top-container mt-2">
                        <h2>Danh sách Size</h2>
                        <a href="#" onclick="addObj(event)" type="button" class="btn btn-primary btn-add">Thêm Size</a>
                    </div>
                    <div class="mb-3 mt-5">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập mã size hoặc tên size" id="inputSearch">
                            <button class="btn btn-primary">Tìm kiếm <i class="fa fa-search" style="font-size: 15px;"></i></button>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Mã Size</th>
                                <th class="table-cell">Size</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody id="container-table">
                            <tr>
                                <td>S001</td>
                                <td>Small</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSize"><i class="fa fa-edit"></i> Sửa</a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="pagination pagination-sm justify-content-end" id="Pagination" style="cursor:pointer; margin-right:1rem;">
                <!-- <li class="page-item"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li> -->
            </ul>

            <div class="footer">
            <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>

    <!-- Modal sửa Size -->
    <div id="editSize-container">
        <div class="modal fade" id="editSize" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Cập nhật thông tin Size</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="sizeCode" class="form-label">Mã size</label>
                                <input type="text" class="form-control" id="sizeCode" name="sizeCode" value="S001" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="sizeName" class="form-label">Tên kích thước</label>
                                <input type="text" class="form-control" id="sizeName" name="sizeName" value="Small">
                            </div>
                            <div style="text-align:right;">
                                <button type="submit" class="btn btn-primary">Cập nhật kích thước</button>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/size.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>