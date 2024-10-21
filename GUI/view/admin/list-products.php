<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin/product.css">

    <style>
    <?php require('../../css/admin/product.css');
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
                        <h2>Danh sách sản phẩm</h2>
                        <a type="button" class="button" href="#!" onclick="addObj(event)" style="text-decoration:none;">
                            <span class="button__text">Thêm mới</span>
                            <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                                    stroke="currentColor" height="24" fill="none" class="svg">
                                    <line y2="19" y1="5" x2="12" x1="12"></line>
                                    <line y2="12" y1="12" x2="19" x1="5"></line>
                                </svg></span>
                        </a>
                    </div>
                    <div class="mb-3 mt-5 ">
                        <div class="input-group">
                            <input id="value-search" type="text" class="form-control" id="input-search"
                                placeholder="Nhập mã sản phẩm, tên sản phẩm,...">
                            <!-- <select class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="In Stock">Còn hàng</option>
                                <option value="Out Of Stock">Hết hàng</option>
                            </select> -->

                            <!-- Kiểm tra trên toàn Product nên không phân loại -->
                            <select id="category" class="form-select">
                                <option value="empty">Tất cả danh mục</option>
                                <option value="shirtProduct">Quần áo</option>
                                <option value="handbagProduct">Túi xách</option>
                            </select>
                            <!-- <select class="form-select">
                                <option value="">Tất cả nhà cung cấp</option>
                                <option value="Nike">NCC001</option>
                                <option value="Adidas">NCC002</option>
                            </select> -->
                            <button onclick="Search(1,5)" class="btn btn-primary">Tìm kiếm <i class="fa fa-search"
                                    style="font-size: 15px;"></i></button>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="fw-bold">Tên sản phẩm</th>
                                <th class="fw-bold">Mã sản phẩm</th>
                                <th class="fw-bold">Ảnh</th>
                                <th class="fw-bold">Số lượng</th>
                                <th class="fw-bold">Giá</th>
                                <th class="fw-bold">Trạng thái</th>
                                <th class="fw-bold">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="listProduct">
                            <!-- <tr>
                                <td>Nike T-Shirt</td>
                                <td>001</td>
                                <td><img src="./logo-sgu.png" width="50px"></td>
                                <td>10</td>
                                <td>20$</td>
                                <td>Clothes</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i>Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"> </i>Xóa</a>
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fa fa-eye"> </i>Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Nike T-Shirt</td>
                                <td>001</td>
                                <td><img src="./logo-sgu.png" width="50px"></td>
                                <td>10</td>
                                <td>20$</td>
                                <td>Clothes</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i>Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"> </i>Xóa</a>
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fa fa-eye"> </i>Xem</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Nike T-Shirt</td>
                                <td>001</td>
                                <td><img src="./logo-sgu.png" width="50px"></td>
                                <td>10</td>
                                <td>20$</td>
                                <td>Clothes</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i>Sửa</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"> </i>Xóa</a>
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fa fa-eye"> </i>Xem</a>
                                </td>
                            </tr> -->

                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-sm justify-content-end" id="Pagination"
                    style="margin-right:.25rem; cursor:pointer;">
                    <!-- <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">Previous</a></li>
                    <li class="admin-pageNav-item active"><a class="admin-pageNav-link" href="">1</a></li>
                    <li class="admin-pageNav-item"><a class="admin-pageNav-link" href="">2</a></li>
                    <li class="admin-pageNav-item"><a class="admin-pageNav-link " href="">Next</a></li> -->
                </ul>

                <!-- Modal sửa sản phẩm -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Sửa sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    <div class="mb-3">
                                        <label for="productCode" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" id="productCode" name="productCode"
                                            disabled placeholder="P001">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nameProduct" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="nameProduct" name="nameProduct">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputFile" class="form-label">Ảnh(PNG,JPG)</label>
                                        <input type="file" class="form-control" id="inputFile" name="imgProduct"
                                            accept="image/jpeg, image/png" multiple>
                                        <div id="imagePreview" style="padding-top:2px;"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Số lượng</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá</label>
                                        <input type="number" class="form-control" id="price" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Danh mục</label>
                                        <select class="form-select" id="category" name="category">
                                            <option value="">Chọn danh mục</option>
                                            <option value="Clothes">Quần áo</option>
                                            <option value="Bag">Túi xách</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supplierCode" class="form-label">Nhà cung cấp</label>
                                        <select class="form-select" id="supplierCode" name="supplierCode">
                                            <option value="">Chọn nhà cung cấp</option>
                                            <option value="NCC001">Tida</option>
                                            <option value="NCC002">Asura</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="describe" class="form-label">Mô tả sản phẩm</label>
                                        <textarea class="form-control" id="describe" name="describe"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="targetGender" class="form-label">Đối tượng sử dụng</label>
                                        <select class="form-select" id="targetGender" name="targetGender">
                                            <option value="">Select Object</option>
                                            <option value="male">Nam</option>
                                            <option value="female">Nữ</option>
                                            <option value="both">Tất cả</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="in">Còn hàng</option>
                                            <option value="out">Hết hàng</option>
                                        </select>
                                    </div>

                                    <!-- Field riêng quần áo -->
                                    <div class="mb-3">
                                        <label for="shirtStyle" class="form-label">Phong cách</label>
                                        <input type="text" class="form-control" id="shirtStyle" name="shirtStyle">
                                    </div>
                                    <div class="mb-3">
                                        <label for="shirtMaterial" class="form-label">Chất liệu</label>
                                        <input type="text" class="form-control" id="shirtMaterial" name="shirtMaterial">
                                    </div>
                                    <div class="mb-3">
                                        <label for="descriptionMaterial" class="form-label">Mô tả</label>
                                        <input type="text" class="form-control" id="descriptionMaterial"
                                            name="descriptionMaterial">
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-6">
                                            Số lượng
                                            <div class="form-check">
                                                <label for="sizeXL" class="form-check-label">S</label>
                                                <input type="number" id="inputSizeXL" class="form-control" value=""
                                                    placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <label for="sizeXL" class="form-check-label">M</label>
                                                <input type="number" id="inputSizeXL" class="form-control" value=""
                                                    placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <label for="sizeXL" class="form-check-label">L</label>
                                                <input type="number" id="inputSizeXL" class="form-control" value=""
                                                    placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <label for="sizeXL" class="form-check-label">XL</label>
                                                <input type="number" id="inputSizeXL" class="form-control" value=""
                                                    placeholder="Nhập số lượng">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Field riêng túi xách -->

                                    <div style="text-align:right;">
                                        <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Modal xóa sản phẩm  -->
                <div id="deleteForm">
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Xóa sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc chắn muốn xóa sản phẩm này?
                                    <br>
                                    Mã sản phẩm: P...
                                    <br>
                                    Tên sản phẩm: ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-danger btn-confirm-delete">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="content-product-detail">
                    <!-- Modal xem chi tiết sản phẩm -->
                    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Chi tiết sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div id="content-picture-product" class="col-md-4">
                                            <div id="main-picture-product">
                                                <img src="../../image/product/product1/product-detail-1.png"
                                                    id="imgProduct" width="210px">
                                            </div>
                                            <div id="detail-picture-product" class="img-category mt-2">
                                                <img src="../../image/product/product1/product-detail-1.png"
                                                    id="imgProduct" width="50px">
                                                <img src="../../image/product/product1/product-detail-2.png"
                                                    id="imgProduct" width="50px">
                                                <img src="../../image/product/product1/product-detail-3.png"
                                                    id="imgProduct" width="50px">
                                                <img src="../../image/product/product1/product-detail-4.png"
                                                    id="imgProduct" width="50px">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <!-- Field chung -->
                                                    <tr>
                                                        <th>Tên sản phẩm</th>
                                                        <td id="nameProduct">Nike T-Shirt</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mã sản phẩm</th>
                                                        <td id="productCode">P001</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Giá</th>
                                                        <td id="price">20$</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Danh mục</th>
                                                        <td id="category">Quần áo</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nhà cung cấp</th>
                                                        <td id="codeSupplier">NCC001</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mô tả</th>
                                                        <td id="describe">Siuiuuuu</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Đối tượng</th>
                                                        <td id="targetGender">Nam</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Trạng thái</th>
                                                        <td id="status">Còn hàng</td>
                                                    </tr>

                                                    <!-- Field riêng quần áo -->
                                                    <tr>
                                                        <th>Phong cách</th>
                                                        <td id="shirtStyle">Sơ mi</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Chất liệu</th>
                                                        <td id="shirtMaterial">Lụa</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mô tả chất liệu</th>
                                                        <td id="descriptionMaterial">Sơ mi nhung lụa cao cấp</td>
                                                    </tr>
                                                    <!-- Size số lượng -->
                                                    <tr style="border-top:2px solid black;">
                                                        <th>Size</th>
                                                        <th id="descriptionMaterial">Số lượng</th>
                                                    </tr>
                                                    <div id="content-size-detail">
                                                        <tr>
                                                            <td>S</td>
                                                            <td>10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>M</td>
                                                            <td>10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>L</td>
                                                            <td>10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>XL</td>
                                                            <td>10</td>
                                                        </tr>
                                                    </div>

                                                    <tr id="quantity-infor">
                                                        <th>Tổng</th>
                                                        <td id="quantity">40</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo time(); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="../../Js/admin/product.js?v=<?php echo time(); ?>"></script>

</body>

</html>