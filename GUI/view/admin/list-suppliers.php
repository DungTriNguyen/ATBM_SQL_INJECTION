<!DOCTYPE html>
<html lang="en">
<?php require('../../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhà cung cấp</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        <?php require('../../css/admin/sidebar.css');
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
                        <h2>Nhà cung cấp</h2>
                        <a href="#!" onclick="addObj(event)" type="button" class="btn btn-primary btn-add">Thêm nhà cung cấp</a>
                    </div>
                    <div class="mb-3 mt-5 ">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập mã nhà cung cấp" id="input-search-supplier">
                            <button class=" btn btn-primary">Tìm kiếm <i class="fa fa-search" style="font-size: 15px;"></i></button>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Mã nhà cung cấp</th>
                                <th class="table-cell">Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Thương hiệu cung cấp</th>
                                <th>Số điện thoại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="table-supplier">
                            <!-- <tr>
                                <td>NCC001</td>
                                <td>Tida Official</td>
                                <td>Ho Chi Minh City</td>
                                <td>tidaofficial@gmail.com</td>
                                <td>Tida</td>
                                <td>0123456789</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editSupplier"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSupplier"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>NCC002</td>
                                <td>Asura Official</td>
                                <td>Ho Chi Minh City</td>
                                <td>asuraofficial@gmail.com</td>
                                <td>Asura, Nike, Adidas</td>
                                <td>0123456789</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editSupplier"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSupplier"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr> -->
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

    <!-- Modal xóa nhà cung cấp-->

    <!-- Modal xóa nhà cung cấp-->
    <div id="delete-Supplier">
        <div class="modal fade" id="deleteSupplier" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xóa nhà cung cấp</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa nhà cung cấp này?
                        <br>
                        Mã nhà cung cấp: ...
                        <br>
                        Tên nhà cung cấp: ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-danger btn-confirm-delete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal sửa nhà cung cấp -->
    <div id="edit-Supplier">
        <div class="modal fade" id="editSupplier" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Sửa nhà cung cấp</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Mã nhà cung cấp</label>
                                <input type="text" class="form-control" id="codeSupplier" name="codeSupplier" placeholder="NCC001" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên nhà cung cấp</label>
                                <input type="text" class="form-control" id="nameSupplier" name="nameSupplier">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="brandsuppliers" class="form-label">Thương hiệu cung cấp</label>
                                <input type="text" class="form-control" id="brandSupplier" name="brandSupplier">
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                <textarea class="form-control" id="phoneNumber" name="phoneNumber"></textarea>
                            </div>
                            <div style="text-align:right;">
                                <button type="submit" class="btn btn-primary">Sửa nhà cung cấp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script>
    <script src="../../Js/admin/supplier.js?v=<?php echo $version ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>