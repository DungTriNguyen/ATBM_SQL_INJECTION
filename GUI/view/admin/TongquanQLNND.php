<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        <?php require('../../css/admin/sidebar.css');
        require('../../css/admin/header_admin.css');
        require('../../css/admin/footer_admin.css');
        // require('../../css/admin/danhsachnguoidung2.css');
        require('../../css/admin/QLND.css');
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
                <div>
                    <h1>QUẢN LÝ NHÓM NGƯỜI DÙNG</h1>
                    <a href="tongquanthemQLNND.php" class="add-new"><i class="fa fa-plus"></i>Thêm nhóm mới</a>
                </div>
                <div class="tim-kiem">
                    <form action="TongquanQLNND.php" method="get">
                        <input type="text" name="tenTimKiem" id="input-search-accountgroup" placeholder="Nhập dữ liệu tìm kiếm nhóm người dùng">
                        <!-- <button class="search" type="submit">Tìm kiếm</button> -->
                    </form>
                </div>
                <table class="danh-sach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Phân quyền</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="danhsach">
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td><a href="tongquanphanquyenQLNND.php" class="phanquyen">Phân quyền</a></td>
                            <td><a class="edit-button">
                                    <i class="fa fa-edit"></i>Sửa</a></td> -->
                        <!-- <td><a class="delete-button">
                                    <i class="fa fa-trash"></i>Xóa</a></td> -->
                        <!-- <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editSupplier"><i class="fa fa-edit"></i></a> -->
                        <!-- <td> <a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteSupplier"><i class="fa fa-trash"></i></a>
                            <td>
                        </tr> -->
                    </tbody>
                </table>
                <!-- <div class="phan-trang">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div> -->
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
    <!-- Sửa nhóm người dùng -->
    <div id="editNND-container">
        <div class="modal fade" id="editSize" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Cập nhật thông tin Nhóm Người Dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="nndCode" class="form-label">Mã Nhóm Người Dùng</label>
                                <input type="text" class="form-control" id="nndCode" name="nndCode" value="admin" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="sizeName" class="form-label">Tên Nhóm Người Dùng</label>
                                <input type="text" class="form-control" id="nndName" name="nndName" value="Quyền quản trị admin">
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
    <!--  Xóa nhómm người dùng -->
    <div id="delete-AccountGroup">
        <div class="modal fade" id="deleteAccountGroup" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xóa nhóm người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa nhóm người dùng này?
                        <br>
                        Mã nhóm:
                        <br>
                        Tên nhóm: ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-danger btn-confirm-delete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/managerusergroup.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>